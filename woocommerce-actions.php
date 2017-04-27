<?php


/**
 * Add 'Return to Home' button after displaying order details.
 */
add_action( 'woocommerce_thankyou', 'austeve_woocommerce_return_to_home', 50, 0 );
function austeve_woocommerce_return_to_home( ) { 
?>
    <div class='order-received-next-up'>
        <div class='row text-center'>
            <div class='small-12 medium-6 medium-text-right columns'>
                <a class='button' href='<?php echo site_url('events');?>'>Expand your collection</a>
            </div>
            <div class='small-12 medium-6 medium-text-left columns'>
                <a class='button' href='<?php echo site_url();?>'>Return home</a>
            </div>
        </div>
    </div>
<?php
}

/**
 * Remove the 'Order Again' button from the order-received page
 */
remove_action( 'woocommerce_order_details_after_order_table', 'woocommerce_order_again_button' );

// define the woocommerce_thankyou_order_received_text callback 
function austeve_woocommerce_thankyou_order_received_text( $var, $order ) { 
    $var = "Thank you. Your order has been received.";
	return $var; 
}; 
         
// add the filter 
add_filter( 'woocommerce_thankyou_order_received_text', 'austeve_woocommerce_thankyou_order_received_text', 10, 2 ); 

?>