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


function austeve_append_event_details_to_purchase_email($order, $sent_to_admin, $plain_text, $email)
{
	// error_log("Order: ".print_r($order, true));
	// error_log("SentToAdmin: ".print_r($sent_to_admin, true));
	// error_log("Plain Text: ".print_r($plain_text, true));
	// error_log("Email: ".print_r($email, true));

	/*
	 * Only add extra details when sending the Completed order email
	 */
	if ($email->id == 'customer_completed_order')
	{
		$items = $order->get_items();
		$products = array();
		foreach ( $items as $item ) {
		    $product_name = $item['name'];
		    $product_id = $item['product_id'];
		    $product_variation_id = $item['variation_id'];

		    $products[] = $product_id;
		}
		error_log("Products purchased: ".implode(",", $products));

		$args = array(
		    'do_not_filter' => true,
		    'post_type' => 'austeve-events',
		    'post_status' => array('publish'),
		    'number_of_posts' => -1
		);

		$args['meta_query'] = array(
			array(
				'key'           => 'wc_product',
			    'compare'       => 'IN',
			    'value'         => implode(",", $products),
			    'type'          => 'NUMERIC',
		    )
		);
		error_log("Arguments for event query: ".print_r($args, true));

		global $post;
		$eventposts = get_posts( $args );

		/**
		 * If one event has been purchased 
		 */
		if (count($eventposts) > 0) {
			error_log("1 event purchased");

			echo "<h2>On event night</h2>";

			foreach ( $eventposts as $post ) : setup_postdata( $post ); 
				?>
				<?php the_title( '<h3>', '</h3>' );?>
				<p><a href="<?php echo get_permalink();?>">

					<?php
					$creationId = get_field('creation');
					if ( has_post_thumbnail( $creationId ) ) 
					{
						echo get_the_post_thumbnail( $creationId, array( 300, 300) );
					}
					else 
					{
						$the_creation_image = get_field('image', $creationId);
					?>

						<img src="<?php echo $the_creation_image['sizes']['thumbnail'];?>" width="<?php echo $the_creation_image['sizes']['thumbnail-width'];?>" height="<?php echo $the_creation_image['sizes']['thumbnail-height'];?>"/>
					<?php
					}
					?>
					</a>

				<p><strong>Start Time:</strong> <?php 
				if (get_field('start_time'))
				{
					$eventDate = DateTime::createFromFormat('Y-m-d H:i:s', get_field('start_time'));
					echo $eventDate->format('F jS Y @g:ia'); 
				}
				?>
				
				<p><strong>Venue:</strong> <?php 
				$venue = get_field('venue');
				echo $venue->post_title;
				?>
				<br/><?php $location = get_field('address', $venue->ID);
				if( !empty($location) ) :
					echo $location['address'];
				?>
					<br/>
					<a href='https://www.google.ca/maps/place/<?php echo urlencode($location['address']);?>' target='_blank'><i class="fa fa-car" aria-hidden="true"></i>Directions</a>
				<?php endif;?>
	
				<p><strong>Arrival:</strong> <?php echo get_field('arrival'); ?>

				<p><strong>Seating:</strong> <?php echo get_field('seating'); ?>

				<p><strong>Event Length:</strong> <?php echo get_field('event_duration'); ?>

				<p><strong>Age Requirement:</strong> <?php echo get_field('age_requirement'); ?>

				<p><strong>Dress code:</strong> <?php echo get_field('dress_code'); ?>

				<p><a href="<?php echo get_permalink();?>">View event page</a>
			<?php

			endforeach; 

			wp_reset_postdata();
		}
		else
		{
			error_log("Only gift certificate(s) purchased??");
		}
	}
}

add_action ('woocommerce_email_order_meta', 'austeve_append_event_details_to_purchase_email', 50, 4);


function austeve_append_terms_to_purchase_email()
{
	// Also print links to terms & conditions and privacy policy
	?>
		<p><a href="<?php echo site_url('terms-conditions');?>">Terms & Conditions</a> | <a href="<?php echo site_url('privacy-policy');?>">Privacy Policy</a>
	<?php
}
add_action ('woocommerce_email_customer_details', 'austeve_append_terms_to_purchase_email', 50, 0);
?>