<?php
/**
 * The template for displaying all single folio posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-folio
 *
 * @package WordPress
 * @subpackage Eléctrico
 * @since 1.0
 * @version 1.0
 */

get_header(); 
$term = get_the_terms( $the_id, 'portfolio_cat' );
$single_cat='';
if($term)$single_cat=$term[0]->name;
?>
<div class="container mt-40">
    <div class="row">
        <div class="col-md-12 pl-0 pr-0 mb-10">
            <h1 class="category-title d-inline"><?php _e('Portfolio','eletrico');?></h1>
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
                    
                        if( get_post_thumbnail_id() ):
                        $orig_image = wp_get_attachment_url( get_post_thumbnail_id() );
                            echo '<div class="col-md-6">';
                            echo '<img class="img-fluid" src="'.$orig_image.'" alt="'.get_the_title().'">';
                            echo '</div>';
                        endif;
                        
                        /*$custom_gallery = get_post_meta(get_the_ID(), '_custom_gallery', true);
                        if( $custom_gallery ):
                            $_gallery=explode(',',$custom_gallery);
                            foreach($_gallery as $item):
                                $_src=wp_get_attachment_url($item);
                                echo '<div class="row mb-15"><div class="col-md-12">';
                                echo '<img class="img-fluid" src="'.$_src.'" alt="'.get_the_title().'">';
                                echo '</div></div>';
                            endforeach;
                        endif;*/
                        
                        echo( get_post_thumbnail_id() )? '<div class="col-md-6">':'<div class="col-md-12">';
                            echo '<h2 class="mb-20">'.get_the_title().'</h2>';
                            the_content();
                        
                        echo '<div class="mt-20">';    
                            echo '<a href="https://facebook.com/sharer/sharer.php?u='.get_the_permalink().'" target="_blank" class="mb-10 share text-uppercase"><i class="fa fa-heart"></i></a>';
                        echo '</div>';
                        
                        echo '</div>';
                    
                echo '</div></div>';
                
                $cats=get_post_meta(get_the_ID(),'wpt_related_posts', false);
                if($cats&&count($cats[0])>0){
                    $posts_in=array();
                    foreach($cats[0] as $reP=>$val)
                    {
                        $posts_in[]=$val;
                    }
                    $related=new WP_Query(array( 
                        'post_type' => 'product',
                        'post__in'=>$posts_in,
                        'posts_per_page' => '6',
                        'orderby' => 'title',
                        'order' => 'ASC'
                    ));
                    
                    $counter=1;
                    if($related){
			 	        echo '<div class="container">';
                        echo '<div class="row"><div class="col-xs-12 text-center mb-20"><div class="texto-holder heading-holder mb-20"><h2 class="related text-uppercase">'.__('Shop','eletrico').'</h2></div></div></div>';
                        
			 	        echo '<div class="row">';
                        while ($related->have_posts()) : $related->the_post();
                            $the_id=$related->post_ID;
                    		$the_title=get_the_title($the_id);
                    		$the_excerpt=get_the_excerpt($the_id);
                    		$the_content=get_the_content($the_id);
                    		$the_permalink=get_the_permalink($the_id);
                            $term = get_the_terms( $the_id, 'product_cat' );
                            $single_cat='';
                            if($term)$single_cat='<h5>'.$term[0]->name.'</h5>';
    			 	        echo '<div class="col-md-6">';
                              echo '<div class="portfolio-item mb-30">';
                                        echo '<div class="imageholder">';
                						if(get_post_thumbnail_id($the_id))'<a href="'.$the_permalink.'" title="'.$the_title.'">'.the_post_thumbnail( 'square_thumbs',array('class' => 'attachment-full img-fluid') ).'</a>';
                						echo '<a href="'.$the_permalink.'" class="imageholder-overlay" '.(($custom_link)?'target="_blank"':'').' title="'.$the_title.'"><h3>'.$the_title.'</h3>'.$single_cat.'</a>';
                                    echo '</div>';
                		      echo '</div>';
                            echo '</div>';
                            echo ($counter>1&&$counter%2==0)?'<div class="clearfix"></div>':'';
                            $counter++;
                        endwhile;//end loop
                        echo '</div>';
                        echo '</div>';
                    }
                    wp_reset_postdata();
                }
			endwhile;
		endif; ?>


<?php get_footer();
