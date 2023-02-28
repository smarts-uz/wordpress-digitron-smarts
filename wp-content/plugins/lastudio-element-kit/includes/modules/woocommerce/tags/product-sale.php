<?php
namespace LaStudioKitThemeBuilder\Modules\Woocommerce\Tags;

use Elementor\Controls_Manager;
use LaStudioKitThemeBuilder\Modules\Woocommerce\Tags\Traits\Tag_Product_Id;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Product_Sale extends Base_Tag {
	public function get_name() {
		return 'woocommerce-product-sale-tag';
	}

	public function get_title() {
		return esc_html__( 'Product Sale', 'lastudio-kit' );
	}

	protected function register_controls() {
		$this->add_control( 'text', [
			'label' => esc_html__( 'Text', 'lastudio-kit' ),
			'type' => Controls_Manager::TEXT,
			'default' => esc_html__( 'Sale!', 'lastudio-kit' ),
		] );

		$this->add_product_id_control();
	}

	public function render() {
		$product = wc_get_product( $this->get_settings( 'product_id' ) );
		if ( ! $product ) {
			return;
		}

		$value = '';

		if ( $product->is_on_sale() ) {
			$value = $this->get_settings( 'text' );
		}

		echo wp_kses_post( $value );
	}
}
