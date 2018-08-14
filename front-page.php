<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Eléctrico
 * @since 1.0
 * @version 1.0
 */

get_header(); 

if ( have_posts() ) :
while ( have_posts() ) : the_post();
the_content();
endwhile;
endif;
get_footer();