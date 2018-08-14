<?php
/**
 * The template for displaying all categories
 *
 * This is the template that displays all categorized posts by default.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Eléctrico
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<?php /*<div class="container mt-40">
<div class="row">
    <div class="col-md-12 mb-30">
        <h1 class="category-title">Portfolio</h1>
        <div class="category-subtitle"><span>//</span>   <?php echo single_cat_title();?></div>
    </div>
</div>*/?>
<div class="container">
    <div class="row">
    		<?php
            $i=0;
    		if ( have_posts() ) :
    			while ( have_posts() ) : the_post();
                    /*echo '<div class="col-md-6 col-xs-12">';
                        echo '<div class="portfolio-item mt-30">';
                            echo '<div class="imageholder">';
                				echo '<a href="'.get_permalink().'" title="'.get_the_title().'">';
                				if(get_post_thumbnail_id())the_post_thumbnail( 'square_thumbs',array('class' => 'attachment-full img-responsive') );
                				echo '</a>';
                                echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="imageholder-overlay text-center"><h2 class="text-center">'.get_the_title().'</h2></a>';
                            echo '</div>';
        				//echo get_the_content();
                        echo '</div>';
                    echo '</div>';*/
                    $image_id = get_post_thumbnail_id ( get_the_ID() );
                    if( $i==0 )echo '<div class="col-sm-8 pl-0 pr-0">';
                            
                            //if( $i==3 )echo '</div><div class="vc_col-sm-3">';
                                if( $i==1 )echo '<div class="vc_row wpb_row"><div class="vc_col-sm-6 pr-0">';
                                    echo '<div id="portfolio_item-'.get_the_ID().'" class="vc-eletrico_mosaic-item">';
                                        if($image_id){
                                        if( $i==0 || $i==3 )$img_src = wp_get_attachment_image_src ( $image_id, '16_3_thumbs' );
                                        else $img_src = wp_get_attachment_image_src ( $image_id, '5_10_thumbs' );
                                        echo '<img src="'.$img_src[0].'" class="img-fluid">';
                                        } 
                                        echo '<div class="vc-eletrico_mosaic-item-overlay">';
                                        echo '<div class="vc-eletrico_mosaic-item-overlay-content">';
                                        echo '<h3 class="vc-eletrico_mosaic-item-title">'.get_the_title().'</h3>';
                                        echo '<a class="btn '.$btn_style.' vc-eletrico_mosaic-item-link text-uppercase" href="'.get_permalink().'">'.__('Ver mais','hipercriativo').'</a>';
                                        echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                if( $i==1 )echo '</div><div class="vc_col-sm-6 pl-0">'; 
                                if( $i==2 )echo '</div>';  //end col6 
                                if( $i==2 )echo '</div>';  //end row 
                            
                     if( $i==3 )echo '</div>';//end col8
                            
                    $i++;
    			endwhile;
            else:
            echo '<div class="col-xs-12"><h2>'.__('Nothing to declare', 'eletrico').'</h2></div>';
    		endif; ?>
    </div>
</div>

<?php get_footer();
