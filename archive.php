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

<div class="container mt-40">
<div class="row">
    <div class="col-md-12 mb-30">
        <h1 class="category-title">Arquivo</h1>
        <div class="category-subtitle"><span>//</span> <?php echo single_cat_title();?></div>
    </div>
</div>
<div class="row">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
                echo '<div class="col-md-6 col-xs-12">';
                    echo '<div class="';
                    echo ( 'folio'==get_post_type(get_the_ID()) )?'portfolio-item':'categoria-item';
                    echo ' mb-30">';
                        echo '<div class="imageholder">';
            				echo '<a href="'.get_permalink().'" title="'.get_the_title().'">';
            				if(get_post_thumbnail_id())the_post_thumbnail( 'square_thumbs',array('class' => 'attachment-full img-responsive') );
            				echo '</a>';
                            echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="imageholder-overlay"><h3>'.get_the_title().'</h3></a>';
                        echo '</div>';
    				//echo get_the_content();
                    echo '</div>';
                echo '</div>';
			endwhile;
        else:
        echo '<div class="col-xs-12"><h2>'.__('Nothing to declare', 'eletrico').'</h2></div>';
		endif; ?>
</div>
</div>

<?php get_footer();
