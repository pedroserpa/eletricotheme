<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Eléctrico
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="robots" content="index,follow">
<meta name="googlebot" content="index,follow">
<link rel="profile" href="http://gmpg.org/xfn/11">
<meta property="fb:admins" content="FBID"/>
<meta property="og:url" content="<?php echo get_the_permalink();?>">
<meta property="og:title" content="<?php echo get_the_title();?>">
<meta property="og:description" content="<?php echo (get_the_excerpt())?get_the_excerpt():strip_tags( get_the_content() );?>...">
<?php wp_head(); ?>
<?php
$custom_logo=get_option('header_logo');
$alt_logo=get_option('alt_logo');
$orig_image=$custom_logo;
$favicon=get_option('favicon_logo');
if($favicon&&$favicon!='')echo '<link rel="shortcut icon" href="'.$favicon.'">';
if( get_post_thumbnail_id() ):
$orig_image = wp_get_attachment_url( get_post_thumbnail_id() );
echo '<meta property="og:image" content="'.$orig_image.'">';
endif;

$header_style = get_option( 'header_style' );
$fullscreen_nav = get_option( 'fullscreen_nav' );
?>
</head>

<body <?php body_class(); ?>>
   <header class="page-header" id="masthead" role="banner">
   <div class="container">
    <nav class="main <?php echo ($header_style);?>">
      <?php
      echo($fullscreen_nav&&$fullscreen_nav=='1')?'<a href="#" id="fullscreen-toggler"><span class="icon"></span></a>':'';
    
      if($header_style&&$header_style=='logo_on_left'):
          echo '<a class="navbar-brand text-left" href="'.home_url("/").'"><img src="';
          echo ($alt_logo)?$alt_logo:$custom_logo;
          echo '" class="img-fluid"></a>';
          
          echo '<div class="float-right">';
          wp_nav_menu( array(
    		'theme_location' => 'top',
    		'menu_id'        => 'top-menu',
    	  ));
          echo '</div>';
      else:
          echo '<a class="navbar-brand align-center" href="'.home_url("/").'"><img src="';
          echo ($alt_logo)?$alt_logo:$custom_logo;
          echo '" class="img-fluid"></a>';
          echo '<div class="align-center">';
          if(!$fullscreen_nav||$fullscreen_nav!='1')
          {
            wp_nav_menu( array(
    		'theme_location' => 'top',
    		'menu_id'        => 'top-menu',
            ));
          }
          echo '</div>';
      endif;
      ?>
    </nav>
    </div>
  </header>
  <div class="fullscreen-nav">
    <div class="content">
      <a href="#" class="close"><span class="icon"></span></a>
     <nav class="main text-center">
     <div class="clearfix"></div>
      <?php wp_nav_menu( array(
		'theme_location' => 'fullscreen',
		'menu_id'        => 'fullscreen-menu',
	  )); ?>
    </nav>
    </div>
  </div>
<div id="content" class="main-content">