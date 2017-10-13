<?php
/**
 * Additional Information tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/additional-information.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$heading = esc_html( apply_filters( 'woocommerce_product_additional_information_heading', __( 'Product Information', 'woocommerce' ) ) );

?>

<?php if ( $heading ) : ?>
	<h2><?php echo $heading; ?></h2>
<?php endif; ?>

<div class="product_information">

	<?php if ( $product->has_dimensions() ) : ?>
	<div class="row product-information" id="product-dimensions">
		<div class='small-3 columns'>
			Dimensions:
		</div>
		<div class='small-9 columns'>
			<?php echo wc_format_dimensions($product->get_dimensions(false)); ?>
		</div>
	</div>
	<?php endif; ?>

	<?php if ( $product->has_weight() ) : ?>
	<div class="row product-information" id="product-weight">
		<div class='small-3 columns'>
			Weight:
		</div>
		<div class='small-9 columns'>
			<?php echo wc_format_weight($product->get_weight()); ?>
		</div>
	</div>
	<?php endif; ?>

</div>


