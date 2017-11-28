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

	//Remove the 'Description' header from single product pages because it isn't displayed in a tab anymore
	add_filter('woocommerce_product_description_heading', '__return_empty_string');

	//Changes the text and style of the stock availability message
	add_filter( 'woocommerce_get_stock_html', 'austeve_filter_woocommerce_get_stock_html', 10, 1 ); 

    //Insert sidebar on WC product archive pages
    add_action('woocommerce_before_shop_loop', 'austeve_wc_sidebar_left_start', 15);
    add_action('woocommerce_after_shop_loop', 'austeve_wc_sidebar_left_end', 15);
    add_action('woocommerce_no_products_found', 'austeve_wc_sidebar_left_start', 15);
    add_action('woocommerce_no_products_found', 'austeve_wc_sidebar_left_end', 20);

    //Replace result count with custom breadcrumbs on WC product archive pages
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    add_action( 'woocommerce_before_shop_loop', 'woocommerce_breadcrumb', 20, 0 );
    add_filter( 'woocommerce_breadcrumb_defaults', 'austeve_wc_change_breadcrumb_delimiter' );
    
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

function austeve_filter_woocommerce_get_stock_html( $html ) { 
    
    //If product is in stock, do not show the html
    if (strpos($html, 'in-stock')) :
    	return "";
    endif;

    //If product is out of stock, change shit up
    if (strpos($html, 'out-of-stock')) :
    	$html = str_replace('Out of stock', 'SOLD', $html); 
    	$html = str_replace('<p', '<button', $html); 
    	$html = str_replace('</p', '</button', $html); 
    	$html = str_replace('class="', 'class="button alt ', $html); 
    	return $html;
    endif;

    //any other cases
    return $html;
}; 

function austeve_wc_sidebar_left_start() {
    
    
    ob_start();
    get_sidebar('sidebar-1');
    $the_sidebar = ob_get_contents();
    ob_end_clean();

    ob_start();
    ?>
    <div class='row'>
    <div class='small-12 medium-3 columns'>
        <div id="filters-accordion" class='show-for-small-only'>
            <h3 class="title">Filter</h3>
            <div class="filter-content">
                <?php echo $the_sidebar; ?>
            </div>
        </div>
        <div class='show-for-medium'>
            <?php echo $the_sidebar; ?>
        </div>
    </div>
    <div class='small-12 medium-9 columns shop-content'>
    <?php
    $output = ob_get_contents();
    ob_end_clean();

    echo $output;
}

function austeve_wc_sidebar_left_end() {
    echo "</div> <!--END .shop-content-->";
    echo "</div> <!--END .row-->";
}

function austeve_wc_change_breadcrumb_delimiter( $defaults ) {
    // Change the breadcrumb delimeter from '/' to '+'
    $defaults['delimiter'] = ' + ';
    return $defaults;
}
?>