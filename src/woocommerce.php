<?php
/** WooCommerce customizations
 * 
 */

add_action( 'wp_head', function() {

	//Remove the 'Sale' dot from products the archive page
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

	//Remove the 'Add to cart' button from the archive products
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

});

?>