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
$option_logos = get_option( 'electrico_theme_options_logos',true );
$custom_logo=$option_logos['header_logo'];
$alt_logo=$option_logos['alt_logo'];
$orig_image=$custom_logo;
$favicon=$option_logos['favicon_logo'];
if($favicon&&$favicon!='')echo '<link rel="shortcut icon" href="'.$favicon.'">';
if( get_post_thumbnail_id() ):
$orig_image = wp_get_attachment_url( get_post_thumbnail_id() );
echo '<meta property="og:image" content="'.$orig_image.'">';
endif;

$header_styles=get_option('electrico_theme_options_header_styles',true);
?>
</head>
<body <?php body_class(); ?>>
   <header class="page-header" id="masthead" role="banner">
   <?php if ($header_styles['show_toolbar']&&$header_styles['show_toolbar']=='1'):?>
   <div class="toolbar container-fluid">
    <div class="row">
		<div class="col-md-6"></div>
		
		<div class="col-md-6">
		<?php
		 if(function_exists('icl_get_languages')):
		  echo '<div class="toolbar_menu text-right">';
		  $languages = icl_get_languages('skip_missing=1&orderby=code');
			  if(1 < count($languages)){
				echo '<ul class="lang_nav">';
				foreach($languages as $l){
				  if(!$l['active']):
					echo '<li><a href="'.$l['url'].'">';
					echo ($l['tag']) ? $l['tag'] : $l['language_code'];
					echo '</a></li>';
				  endif;
				}
				echo '</ul>';
			  }
			  echo '</div>';
		  endif;
		  ?>
		</div>
    </div>
   </div>
   <?php endif; ?>
   
   <div class="<?php echo($header_styles['full_width_header_style']&&$header_styles['full_width_header_style']=='1') ? 'container-fluid' : 'container';?>">
    <nav class="main <?php echo($header_styles['header_style']&&!empty($header_styles['header_style']))?$header_styles['header_style']:'';?>">
      <?php
		echo '<a class="navbar-brand align-center d-none d-md-none d-lg-none d-sm-block" href="'.home_url("/").'"><img src="';
		echo ($alt_logo)?$alt_logo:$custom_logo;
		echo '" class="img-fluid"></a>';

      if($header_styles['fullscreen_nav']&&$header_styles['fullscreen_nav']=='1'):
        echo '<div id="fullscreen-toggler">';
          wp_nav_menu( array(
    		'theme_location' => 'top',
    		'menu_id'        => 'top-menu',
    	  ));
          echo '</div>';
      endif;
    
      if($header_styles['header_style']&&$header_styles['header_style']=='logo_on_left'):
          echo '<a class="navbar-brand text-left" href="'.home_url("/").'"><img src="';
          echo ($alt_logo)?$alt_logo:$custom_logo;
          echo '" class="img-fluid"></a>';
          
          echo '<div class="float-right text-right">';
          wp_nav_menu( array(
    		'theme_location' => 'top',
    		'menu_id'        => 'top-menu',
    	  ));
          echo '</div>';
      else:
          echo '<a class="navbar-brand align-center d-none d-lg-block" href="'.home_url("/").'"><img src="';
          echo ($alt_logo)?$alt_logo:$custom_logo;
          echo '" class="img-fluid"></a>';
          
          if(!$header_styles['fullscreen_nav']||$header_styles['fullscreen_nav']!='1')
          {
            echo '<div class="align-center">';
            wp_nav_menu( array(
    		'theme_location' => 'top',
    		'menu_id'        => 'top-menu',
            ));
            echo '</div>';
          }
          
      endif;
      
		  $social_links=get_option('electrico_theme_options_social_links',true);
		  if($social_links):
		  echo '<div class="social-nav"><ul>';
		  if($social_links['facebook_link'])echo '<li><a target="_blank" href="'.$social_links['facebook_link'].'"><i class="fa fa-facebook-square"></i></a></li>';
		  if($social_links['twitter_link'])echo '<li><a target="_blank" href="'.$social_links['twitter_link'].'"><i class="fa fa-twitter"></i></a></li>';
		  if($social_links['instagram_link'])echo '<li><a target="_blank" href="'.$social_links['instagram_link'].'"><i class="fa fa-instagram"></i></a></li>';
		  if($social_links['youtube_link'])echo '<li><a target="_blank" href="'.$social_links['youtube_link'].'"><i class="fa fa-youtube"></i></a></li>';
		  if($social_links['vimeo_link'])echo '<li><a target="_blank" href="'.$social_links['vimeo_link'].'"><i class="fa fa-vimeo"></i></a></li>';
		  if($social_links['linkedin_link'])echo '<li><a target="_blank" href="'.$social_links['linkedin_link'].'"><i class="fa fa-linkedin"></i></a></li>';
		  if($social_links['pinterest_link'])echo '<li><a target="_blank" href="'.$social_links['pinterest_link'].'"><i class="fa fa-pinterest"></i></a></li>';
		  if($social_links['behance_link'])echo '<li><a target="_blank" href="'.$social_links['behance_link'].'"><i class="fa fa-behance"></i></a></li>';
		  if($social_links['googleplus_link'])echo '<li><a target="_blank" href="'.$social_links['googleplus_link'].'"><i class="fa fa-google-plus-square"></i></a></li>';
		  if($social_links['flickr_link'])echo '<li><a target="_blank" href="'.$social_links['flickr_link'].'"><i class="fa fa-flickr"></i></a></li>';
		  if($social_links['xing_link'])echo '<li><a target="_blank" href="'.$social_links['xing_link'].'"><i class="fa fa-xing"></i></a></li>';
		  if($social_links['dribble_link'])echo '<li><a target="_blank" href="'.$social_links['dribble_link'].'"><i class="fa fa-dribble"></i></a></li>';
		  echo '</ul></div>';
		  endif;
      echo '</div>';
      ?>
    </nav>
    </div>
  </header>
  
  <?php if($header_styles['fullscreen_nav']&&$header_styles['fullscreen_nav']=='1'):?>
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
  <?php endif; ?>
  
<main id="content" class="main-content" role="main">