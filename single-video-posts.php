<?php
/**
 * The template for displaying all single videos posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-video-post
 *
 * @package WordPress
 * @subpackage Eléctrico
 * @since 1.0
 * @version 1.0
 */

get_header(); 
$term = get_the_terms( get_the_ID(), 'video_cat' );
$single_cat='';
if($term)$single_cat=$term[0]->name;
?>
<div class="container mt-40">
    <div class="row">
        <div class="col-md-12 pl-0 pr-0 mb-10">
            <h1 class="category-title d-inline"><?php _e('Videos','eletrico');?></h1>
            <?php if($single_cat&&$single_cat!=''):?>
            <div class="category-subtitle d-inline"><span>//</span> <?php echo $single_cat;?></div>
            <?php endif;?>
        </div>
    </div>
    <div class="row"><div class="col-md-12 pl-0 pr-0 mb-30"><a href="#" onclick="window.history.go(-1); return false;" id="voltar"><?php _e('Voltar','eletrico');?></a></div></div>
</div>
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				echo '<div class="container mb-70"><div class="row">';
                        $video_url = get_post_meta( $post->ID, 'wp_video_url', true );
                        if($video_url&&getVideoID($video_url)!==false){
                            echo '<div class="col-md-6 pl-0">';
                            echo '<iframe width="100%" height="380" src="https://www.youtube.com/embed/'.getVideoID($video_url).'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
                            echo '</div>';
                        }elseif( get_post_thumbnail_id() ){
                        $orig_image = wp_get_attachment_url( get_post_thumbnail_id() );
                            echo '<div class="col-md-6 pl-0">';
                            echo '<img class="img-fluid" src="'.$orig_image.'" alt="'.get_the_title().'">';
                            echo '</div>';
                        }
                        
                        echo( $video_url&&getVideoID($video_url)!==false||get_post_thumbnail_id() )? '<div class="col-md-6 pr-0">':'<div class="col-md-12 pl-0 pr-0">';
                            echo '<h2 class="mb-20">'.get_the_title().'</h2>';
                            the_content();
                        
                        echo '<div class="mt-20">';    
                            echo '<a href="https://facebook.com/sharer/sharer.php?u='.get_the_permalink().'" target="_blank" class="mb-10 share text-uppercase"><i class="fa fa-heart"></i></a>';
                        echo '</div>';
                        
                        echo '</div>';
                    
                echo '</div></div>';
                
                wp_reset_postdata();
			endwhile;
		endif; ?>


<?php get_footer();

