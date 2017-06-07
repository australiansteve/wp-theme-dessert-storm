<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Dessertstorm
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function dessertstorm_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'dessertstorm_body_classes' );

/**
 * Make YouTube and Vimeo oembed elements responsive. Add Foundation's .flex-video
 * class wrapper around any oembeds
 */
function dessertstorm_oembed_flex_wrapper( $html, $url, $attr, $post_ID ) {
	if ( strpos( $url, 'youtube' ) || strpos( $url, 'youtu.be' ) || strpos( $url, 'vimeo' ) ) {
		return '<div class="flex-video widescreen">' . $html . '</div>';
	}

	return $html;
}
add_filter( 'embed_oembed_html', 'dessertstorm_oembed_flex_wrapper', 10, 4 );


//Remove WooCommerce hook for displaying product information
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 ); 

//Moves the location of 'Coupon Receiver Details' from after the customer details to before the order summary
if (array_key_exists('woocommerce_smart_coupon', $GLOBALS))
{
	remove_action( 'woocommerce_checkout_after_customer_details', array(  $GLOBALS['woocommerce_smart_coupon'], 'gift_certificate_receiver_detail_form' ) );
	add_action( 'woocommerce_checkout_before_order_review', array(  $GLOBALS['woocommerce_smart_coupon'], 'gift_certificate_receiver_detail_form' ) );
}

//Removes the 'Additional Notes' part of the checkout page
add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );

//Changes the set of endpoints displayed in the menu on the WC My Account page
function austeve_woo_my_account_order() {
 $myorder = array(
 'dashboard' => __( 'Dashboard', 'woocommerce' ),
 'my-reviews' => __( 'Reviews', 'woocommerce' ),
 'orders' => __( 'Orders', 'woocommerce' ),
 'edit-account' => __( 'Change My Details', 'woocommerce' ),
 'edit-address' => __( 'Addresses', 'woocommerce' ),
 'payment-methods' => __( 'Payment Methods', 'woocommerce' ),
 'wc-smart-coupons' => __( 'Gift Certificates & Coupons', 'woocommerce' ),
 'customer-logout' => __( 'Logout', 'woocommerce' ),
 );
 return $myorder;
}
add_filter ( 'woocommerce_account_menu_items', 'austeve_woo_my_account_order' );

function austeve_wc_remove_password_strength() {
	if ( wp_script_is( 'wc-password-strength-meter', 'enqueued' ) ) {
		wp_dequeue_script( 'wc-password-strength-meter' );
	}
}
add_action( 'wp_print_scripts', 'austeve_wc_remove_password_strength', 100 );
