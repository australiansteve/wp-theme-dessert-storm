<?php
/** WooCommerce customizations
 * 
 */

add_action( 'wp_head', function() {

	//Remove the 'Sale' dot from products the archive page
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

	//Remove the 'Add to cart' button from the archive products
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

	//Remove the 'Sale' dot from products the single product page
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

	//Remove tabs from bottom of single product page
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

	//Adds the product description and additional information into the single product summary area
	add_action('woocommerce_single_product_summary', 'woocommerce_product_description_tab', 35 );
	add_action('woocommerce_single_product_summary', 'woocommerce_product_additional_information_tab', 35 );

	//Remove the 'Description' and 'Additional Information' headers from single product pages because they aren't displayed in tabs any more
	add_filter('woocommerce_product_description_heading', '__return_empty_string');
	add_filter('woocommerce_product_additional_information_heading', '__return_empty_string');

});

function austeve_before_after_content($content) {
    if( is_singular('product') ) {
        $beforecontent = "<div class='product-description'>";
        $aftercontent = "</div>";
        $fullcontent = $beforecontent . $content . $aftercontent;
    } else {
        $fullcontent = $content;
    }
    
    return $fullcontent;
}
add_filter('the_content', 'austeve_before_after_content');

?>