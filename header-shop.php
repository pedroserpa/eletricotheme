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
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="index,follow">
<meta name="googlebot" content="index,follow">
<link rel="profile" href="http://gmpg.org/xfn/11">
<meta property="fb:admins" content="100000712733777"/>
<meta property="og:url" content="<?php echo get_the_permalink();?>">
<meta property="og:title" content="<?php echo get_the_title();?>">
<meta property="og:description" content="<?php echo strip_tags( get_the_content() );?>...">
<?php wp_head(); ?>
<?php
$custom_logo=get_option('header_logo');
$alt_logo=get_option('alt_logo');
$orig_image =$custom_logo;
if( get_post_thumbnail_id() ):
$orig_image = wp_get_attachment_url( get_post_thumbnail_id() );
echo '<meta property="og:image" content="'.$orig_image.'">';
endif;
if($alt_logo&&$alt_logo!='')
{
    echo '<style type="text/css">';
    echo '.navbar-brand {background-image:url('.$custom_logo.');}';
    echo '.sticky .navbar-brand {background-image:url('.$alt_logo.');}';
    echo '</style>';
}
else
{
    if($custom_logo&&$custom_logo!='')
    {
    echo '<style type="text/css">';
    echo '.navbar-brand {background-image:url('.$custom_logo.');}';
    echo '</style>';
    }
}
$link_color = get_option( 'link_color'  );
$hover_link_color = get_option( 'hover_link_color' );
echo '<style type="text/css">';
echo 'a:link {color:'.$link_color.'}';
echo 'a:hover {color:'.$hover_link_color.'}';
echo '</style>';
?>
</head>

<body <?php body_class(); ?>>
	<header id="masthead" class="site-header <?php echo (!is_front_page()&&!is_home())?'sticky':''; ?>" role="banner">
        <?php if ( has_nav_menu( 'top' ) ) : ?>
        <div class="container-fluid">
            <div class="row header-init">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                            if ( is_active_sidebar( 'header-1' ) ) { 
                                dynamic_sidebar( 'header-1' );
                         	}
                            ?>
                        </div>
                        <div class="col-md-6 text-right">
                            <?php wp_nav_menu( array(
                        		'theme_location' => 'top',
                        		'menu_id'        => 'top-menu',
                        	));?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
		<?php if ( has_nav_menu( 'main' ) ) : ?>
                
                    <div class="container">
        				<div class="row">
                            <div class="col-md-12">
        					   <a id="logo" href="<?php echo get_bloginfo('url');?>" class="navbar-brand"><?php echo get_bloginfo('name');?></a>
        				    
                                <div class="navbar text-right">
                                    <button data-toggle="collapse" data-target="#site-navigation" class="menu-toggle pull-right"><i class="fa fa-bars"></i></button>
                                    <ul class="nav-social">
                                        <?php echo ( get_option('facebook_link') )?'<li><a href="'.get_option('facebook_link').'" target="_blank"><i class="fa fa-facebook"></i></a></li>':''; ?>
                                        <?php echo ( get_option('twitter_link') )?'<li><a href="'.get_option('twitter_link').'" target="_blank"><i class="fa fa-twitter"></i></a></li>':''; ?>
                                        <?php echo ( get_option('instagram_link') )?'<li><a href="'.get_option('instagram_link').'" target="_blank"><i class="fa fa-instagram"></i></a></li>':''; ?>
                                        <?php echo ( get_option('dribbble_link') )?'<li><a href="'.get_option('dribbble_link').'" target="_blank"><i class="fa fa-dribbble"></i></a></li>':''; ?>
                                        <?php echo ( get_option('pinterest_link') )?'<li><a href="'.get_option('pinterest_link').'" target="_blank"><i class="fa fa-pinterest"></i></a></li>':''; ?>
                                        <?php echo ( get_option('behance_link') )?'<li><a href="'.get_option('behance_link').'" target="_blank"><i class="fa fa-behance"></i></a></li>':''; ?>
                                        <?php echo ( get_option('linkedin_link') )?'<li><a href="'.get_option('linkedin_link').'" target="_blank"><i class="fa fa-linkedin"></i></a></li>':''; ?>
                                        <?php echo ( get_option('googleplus_link') )?'<li><a href="'.get_option('googleplus_link').'" target="_blank"><i class="fa fa-google-plus"></i></a></li>':''; ?>
                                        <?php echo ( get_option('youtube_link') )?'<li><a href="'.get_option('youtube_link').'" target="_blank"><i class="fa fa-youtube"></i></a></li>':''; ?>
                                        <?php echo ( get_option('vimeo_link') )?'<li><a href="'.get_option('vimeo_link').'" target="_blank"><i class="fa fa-vimeo"></i></a></li>':''; ?>
                                        <?php echo ( get_option('flickr_link') )?'<li><a href="'.get_option('flickr_link').'" target="_blank"><i class="fa fa-flickr"></i></a></li>':''; ?>
                                    </ul>
                                    <nav id="site-navigation" class="main-navigation collapse" role="navigation" aria-label="<?php esc_attr_e( 'Main Menu', 'electrico' ); ?>">
                                        <?php wp_nav_menu( array(
                                    		'theme_location' => 'main',
                                    		'menu_id'        => 'main-menu',
                                    	));?>
                                    </nav><!-- #site-navigation -->
                                </div><!-- .navbar -->
                            </div><!-- .col-md-8 -->
                            
        				</div><!-- .row -->
    				</div><!-- .container -->
                
		<?php endif; ?>
	</header><!-- #masthead -->
	<div class="site-content-contain">
        <?php if(is_page()||is_shop()){?>
        <div class="header-banner">
                            <div id="logo" class="text-center hidden-xs hidden-md">
                            <?php
                            $shop = get_option( 'woocommerce_shop_page_id' );
                            $shop_logo=get_option('shop_logo');
                            if($shop_logo)echo '<a href="'.home_url().'"><img src="'.$shop_logo.'" class="site-logo img-responsive" alt="'.get_bloginfo('name').'"></a>';
                            echo '<h2>'.get_the_title($shop).'</h2>';
                            ?>
                           </div>
        </div>
        <?php } ?>
		<main id="content" class="site-content" role="main">
