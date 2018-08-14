<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * woocommerce_before_single_product hook.
 *
 * @hooked wc_print_notices - 10
 */
 do_action( 'woocommerce_before_single_product' );

 if ( post_password_required() ) {
 	echo get_the_password_form();
 	return;
 }?>
 <div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
 <?php
				
                    //do_action( 'woocommerce_before_single_product_summary' );
                        if( get_post_thumbnail_id() ):
                        $orig_image = wp_get_attachment_url( get_post_thumbnail_id() );
                            echo '<div class="row mb-15"><div class="col-md-12">';
                            echo '<img class="img-responsive" src="'.$orig_image.'" alt="'.get_the_title().'">';
                            echo '</div></div>';
                        endif;
                        
                        global $product;
                        $custom_gallery = $product->get_gallery_attachment_ids();
                        if( $custom_gallery ):
                            foreach($custom_gallery as $item):
                                $_src=wp_get_attachment_url($item);
                                echo '<div class="row mb-15"><div class="col-md-12">';
                                echo '<img class="img-responsive" src="'.$_src.'" alt="'.get_the_title().'">';
                                echo '</div></div>';
                            endforeach;
                        endif;
                        
                        echo '<div class="row"><div class="col-md-12 text-center mb-10">';
                            echo '<h2 class="mt-20 mb-20">'.get_the_title().'</h2>';
                            echo '</div></div>';
                        
                        echo '<div class="row"><div class="col-md-12 text-center">';    
                            echo '<a href="https://facebook.com/sharer/sharer.php?u='.get_the_permalink().'" target="_blank" class="mb-10 share text-uppercase"><i class="fa fa-heart"></i></a>';
                        echo '</div></div>';
                    
                    echo '<div class="row"><div class="col-md-12 text-center mt-20 mb-30">';
                            the_content();
                            echo '</div></div>';
                    
                    echo '<div class="row"><div class="col-md-12 text-center mt-20 mb-30">';
                           woocommerce_template_single_add_to_cart();
                            echo '</div></div>';      
                            
                            
                    woocommerce_related_products();
			//do_action( 'woocommerce_after_single_product_summary' );
?></div>
<?php do_action( 'woocommerce_after_single_product' ); ?>