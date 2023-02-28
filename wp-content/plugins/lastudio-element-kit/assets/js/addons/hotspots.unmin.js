class LaStudioKit_Hotspots extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                hotspot: '.lakit-hotspot',
                tooltip: '.lakit-hotspot__tooltip'
            }
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings('selectors');
        return {
            $hotspot: this.$element.find(selectors.hotspot),
            $hotspotsExcludesLinks: this.$element.find(selectors.hotspot).filter(':not(.lakit-hotspot--no-tooltip)'),
            $tooltip: this.$element.find(selectors.tooltip)
        };
    }

    bindEvents() {
        const tooltipTrigger = this.getCurrentDeviceSetting('tooltip_trigger'),
            tooltipTriggerEvent = 'mouseenter' === tooltipTrigger ? 'mouseleave mouseenter' : tooltipTrigger;

        if (tooltipTriggerEvent !== 'none') {
            this.elements.$hotspotsExcludesLinks.on(tooltipTriggerEvent, event => this.onHotspotTriggerEvent(event));
        }
    }

    onDeviceModeChange() {
        this.elements.$hotspotsExcludesLinks.off();
        this.bindEvents();
    }

    onHotspotTriggerEvent(event) {
        const elementTarget = jQuery(event.target),
            isHotspotButtonEvent = elementTarget.closest('.lakit-hotspot__button').length,
            isTooltipMouseLeave = 'mouseleave' === event.type && (elementTarget.is('.lakit-hotspot--tooltip-position') || elementTarget.parents('.lakit-hotspot--tooltip-position').length),
            isMobile = 'mobile' === elementorFrontend.getCurrentDeviceMode(),
            isHotspotLink = elementTarget.closest('.lakit-hotspot--link').length,
            triggerTooltip = !(isHotspotLink && isMobile && ('mouseleave' === event.type || 'mouseenter' === event.type));

        if (triggerTooltip && (isHotspotButtonEvent || isTooltipMouseLeave)) {
            const currentHotspot = jQuery(event.currentTarget);
            this.elements.$hotspot.not(currentHotspot).removeClass('lakit-hotspot--active');
            currentHotspot.toggleClass('lakit-hotspot--active');
        }
    }


    editorAddSequencedAnimation() {
        this.elements.$hotspot.toggleClass('lakit-hotspot--sequenced', 'yes' === this.getElementSettings('hotspot_sequenced_animation'));
    }

    hotspotSequencedAnimation() {
        const elementSettings = this.getElementSettings(),
            isSequencedAnimation = elementSettings.hotspot_sequenced_animation;

        if ('no' === isSequencedAnimation) {
            return;
        } //start sequenced animation when element on viewport


        const hotspotObserver = elementorModules.utils.Scroll.scrollObserver({
            callback: event => {
                if (event.isInViewport) {
                    hotspotObserver.unobserve(this.$element[0]); //add delay for each hotspot

                    this.elements.$hotspot.each((index, element) => {
                        if (0 === index) {
                            return;
                        }

                        const sequencedAnimation = elementSettings.hotspot_sequenced_animation_duration,
                            sequencedAnimationDuration = sequencedAnimation ? sequencedAnimation.size : 1000,
                            animationDelay = index * (sequencedAnimationDuration / this.elements.$hotspot.length);
                        element.style.animationDelay = animationDelay + 'ms';
                    });
                }
            }
        });
        hotspotObserver.observe(this.$element[0]);
    }

    setTooltipPositionControl() {
        const elementSettings = this.getElementSettings(),
            isDirectionAnimation = 'undefined' !== typeof elementSettings.tooltip_animation && elementSettings.tooltip_animation.match(/^lakit-hotspot--(slide|fade)-direction/);

        if (isDirectionAnimation) {
            this.elements.$tooltip.removeClass('lakit-hotspot--tooltip-animation-from-left lakit-hotspot--tooltip-animation-from-top lakit-hotspot--tooltip-animation-from-right lakit-hotspot--tooltip-animation-from-bottom');
            this.elements.$tooltip.addClass('lakit-hotspot--tooltip-animation-from-' + elementSettings.tooltip_position);
        }
    }

    onInit() {
        super.onInit(...arguments);
        this.hotspotSequencedAnimation();
        this.setTooltipPositionControl();

        if (window.elementor) {
            elementor.listenTo(elementor.channels.deviceMode, 'change', () => this.onDeviceModeChange());
        }
    }

    onElementChange(propertyName) {
        if (propertyName.startsWith('tooltip_position')) {
            this.setTooltipPositionControl();
        }

        if (propertyName.startsWith('hotspot_sequenced_animation')) {
            this.editorAddSequencedAnimation();
        }
    }

}

jQuery( window ).on( 'elementor/frontend/init', () => {
    const addHandler = ( $element ) => {
        elementorFrontend.elementsHandler.addHandler( LaStudioKit_Hotspots, {
            $element,
        } );
    };
    elementorFrontend.hooks.addAction( 'frontend/element_ready/lakit-hotspots.default', addHandler );
} );