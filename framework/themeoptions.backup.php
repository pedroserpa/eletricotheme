<?php

/**
 * @author Pedro Serpa
 * @copyright 2017
 */
defined( 'ABSPATH' ) OR exit;
class ThemeOptions 
{
	function __construct() {
	   if(is_admin())add_action( 'admin_menu', array( $this, 'admin_menu' ) );
       add_action( 'wp_enqueue_scripts', array( $this, 'eletrico_themeoptions_styles_enqueue') );
	}

	function admin_menu() {
		add_menu_page(
			'Theme Options',
			'Theme Options',
			'manage_options',
			'themeoptions',
			array(
				$this,
				'eletrico_options'
			),
            '',
            2
		);
        add_action( 'admin_menu', array($this,'eletrico_options') );
	}

	function  eletrico_options() {
	    global $wpdb,$wp_filesystem;
	    if (!current_user_can('manage_options')) wp_die('Unauthorized user');
        
        $current_user = wp_get_current_user();
        $upload_dir = wp_upload_dir();
        $user_dirname = trailingslashit($upload_dir['basedir']).'eletrico/';
        $user_dirname_url = $upload_dir['baseurl'].'/eletrico/';
        $protocol=is_ssl()?'https':'http';
        $site_url=esc_url( home_url( '/', $protocol ) );
        $css_filename='themeoptions.css';
   
        if (isset($_POST['wphipercriativo_themeoptions_settings'])&&wp_verify_nonce( sanitize_key($_POST['wphipercriativo_themeoptions_settings']), -1 )) 
        {
            if (isset($_POST['lang_menu_custom'])) update_option('lang_menu_custom', $_POST['lang_menu_custom']); if (isset($_POST['lang_menu_custom']) && $_POST['lang_menu_custom']==''||!isset($_POST['lang_menu_custom'])) delete_option('lang_menu_custom');
            if (isset($_POST['facebook_app_id'])) update_option('facebook_app_id', $_POST['facebook_app_id']); if (isset($_POST['facebook_app_id']) && $_POST['facebook_app_id']==''||!isset($_POST['facebook_app_id'])) delete_option('facebook_app_id');
            if (isset($_POST['google_api_id'])) update_option('google_api_id', $_POST['google_api_id']); if (isset($_POST['google_api_id']) && $_POST['google_api_id']==''||!isset($_POST['google_api_id'])) delete_option('google_api_id');
        }
        if (isset($_POST['wphipercriativo_themeoptions_styles'])&&wp_verify_nonce( sanitize_key($_POST['wphipercriativo_themeoptions_styles']), -1 )) 
        {
            if (isset($_POST['body_background'])) update_option('body_background', $_POST['body_background']); if (isset($_POST['body_background']) && $_POST['body_background']==''||!isset($_POST['body_background'])) delete_option('body_background');
            if (isset($_POST['body_text'])) update_option('body_text', $_POST['body_text']); if (isset($_POST['body_text']) && $_POST['body_text']==''||!isset($_POST['body_text'])) delete_option('body_text');
            if (isset($_POST['link_color'])) update_option('link_color', $_POST['link_color']); if (isset($_POST['link_color']) && $_POST['link_color']==''||!isset($_POST['link_color'])) delete_option('link_color');
            if (isset($_POST['hover_link_color'])) update_option('hover_link_color', $_POST['hover_link_color']); if (isset($_POST['hover_link_color']) && $_POST['hover_link_color']==''||!isset($_POST['hover_link_color'])) delete_option('hover_link_color');
            if (isset($_POST['header_link_color'])) update_option('header_link_color', $_POST['header_link_color']); if (isset($_POST['header_link_color']) && $_POST['header_link_color']==''||!isset($_POST['header_link_color'])) delete_option('header_link_color');
            if (isset($_POST['header_hover_link_color'])) update_option('header_hover_link_color', $_POST['header_hover_link_color']); if (isset($_POST['header_hover_link_color']) && $_POST['header_hover_link_color']==''||!isset($_POST['header_hover_link_color'])) delete_option('header_hover_link_color');
        }
    	if (isset($_POST['wphipercriativo_themeoptions_logos'])&&wp_verify_nonce( sanitize_key($_POST['wphipercriativo_themeoptions_logos']), -1 )) 
        {   
           if (isset($_POST['header_logo'])) update_option('header_logo', $_POST['header_logo']); if (isset($_POST['header_logo']) && $_POST['header_logo']==''||!isset($_POST['header_logo'])) delete_option('header_logo');
           if (isset($_POST['alt_logo'])) update_option('alt_logo', $_POST['alt_logo']); if (isset($_POST['alt_logo']) && $_POST['alt_logo']==''||!isset($_POST['alt_logo'])) delete_option('alt_logo');
           if (isset($_POST['shop_logo'])) update_option('shop_logo', $_POST['shop_logo']); if (isset($_POST['shop_logo']) && $_POST['shop_logo']==''||!isset($_POST['shop_logo'])) delete_option('shop_logo');
           if (isset($_POST['mobile_logo'])) update_option('mobile_logo', $_POST['mobile_logo']); if (isset($_POST['mobile_logo']) && $_POST['mobile_logo']==''||!isset($_POST['mobile_logo'])) delete_option('mobile_logo');
           if (isset($_POST['favicon_logo'])) update_option('favicon_logo', $_POST['favicon_logo']); if (isset($_POST['favicon_logo']) && $_POST['favicon_logo']==''||!isset($_POST['favicon_logo'])) delete_option('favicon_logo');
        }
        if (isset($_POST['wphipercriativo_themeoptions_social'])&&wp_verify_nonce( sanitize_key($_POST['wphipercriativo_themeoptions_social']), -1 )) 
        {   
           if (isset($_POST['facebook_link']) && $_POST['facebook_link']!='') update_option('facebook_link', $_POST['facebook_link']); 
           if (isset($_POST['facebook_link']) && $_POST['facebook_link']==''||!isset($_POST['facebook_link'])) delete_option('facebook_link');
           if (isset($_POST['twitter_link']) && $_POST['twitter_link']!='') update_option('twitter_link', $_POST['twitter_link']); 
           if (isset($_POST['twitter_link']) && $_POST['twitter_link']==''||!isset($_POST['twitter_link'])) delete_option('twitter_link');
           if (isset($_POST['instagram_link']) && $_POST['instagram_link']!='') update_option('instagram_link', $_POST['instagram_link']); 
           if (isset($_POST['instagram_link']) && $_POST['instagram_link']==''||!isset($_POST['instagram_link'])) delete_option('instagram_link');
           if (isset($_POST['pinterest_link']) && $_POST['pinterest_link']!='') update_option('pinterest_link', $_POST['pinterest_link']); 
           if (isset($_POST['pinterest_link']) && $_POST['pinterest_link']==''||!isset($_POST['pinterest_link'])) delete_option('pinterest_link');
           if (isset($_POST['behance_link']) && $_POST['behance_link']!='') update_option('behance_link', $_POST['behance_link']); 
           if (isset($_POST['behance_link']) && $_POST['behance_link']==''||!isset($_POST['behance_link']))  delete_option('behance_link');
           if (isset($_POST['linkedin_link']) && $_POST['linkedin_link']!='') update_option('linkedin_link', $_POST['linkedin_link']);
           if (isset($_POST['linkedin_link']) && $_POST['linkedin_link']==''||!isset($_POST['linkedin_link'])) delete_option('linkedin_link');
           if (isset($_POST['googleplus_link']) && $_POST['googleplus_link']!='') update_option('googleplus_link', $_POST['googleplus_link']); 
           if (isset($_POST['googleplus_link']) && $_POST['googleplus_link']==''||!isset($_POST['googleplus_link'])) delete_option('googleplus_link');
           if (isset($_POST['youtube_link']) && $_POST['youtube_link']!='') update_option('youtube_link', $_POST['youtube_link']); 
           if (isset($_POST['youtube_link']) && $_POST['youtube_link']==''||!isset($_POST['youtube_link'])) delete_option('youtube_link');
           if (isset($_POST['vimeo_link']) && $_POST['vimeo_link']!='') update_option('vimeo_link', $_POST['vimeo_link']);
           if (isset($_POST['vimeo_link']) && $_POST['vimeo_link']==''||!isset($_POST['vimeo_link']))  delete_option('vimeo_link');
           if (isset($_POST['flickr_link']) && $_POST['flickr_link']!='') update_option('flickr_link', $_POST['flickr_link']);
           if (isset($_POST['flickr_link']) && $_POST['flickr_link']==''||!isset($_POST['flickr_link'])) delete_option('flickr_link');
           if (isset($_POST['xing_link']) && $_POST['xing_link']!='') update_option('xing_link', $_POST['xing_link']);
           if (isset($_POST['xing_link']) && $_POST['xing_link']==''||!isset($_POST['xing_link'])) delete_option('xing_link');
           if (isset($_POST['dribbble_link']) && $_POST['dribbble_link']!='') update_option('dribbble_link', $_POST['dribbble_link']);
           if (isset($_POST['dribbble_link']) && $_POST['dribbble_link']==''||!isset($_POST['dribbble_link'])) delete_option('dribbble_link');
        }
        if (isset($_POST['wphipercriativo_themeoptions_header_styles'])&&wp_verify_nonce( sanitize_key($_POST['wphipercriativo_themeoptions_header_styles']), -1 )) 
        {
            if( isset($_POST['header_style'])&&$_POST['header_style']!='' ) update_option('header_style',esc_html($_POST['header_style'])); else delete_option('header_style');
            if( isset($_POST['social_menu'])) update_option('social_menu','1'); else delete_option('social_menu');
            if( isset($_POST['show_toolbar'])) update_option('show_toolbar','1'); else delete_option('show_toolbar');
            if( isset($_POST['fullscreen_nav'])) update_option('fullscreen_nav','1'); else delete_option('fullscreen_nav');
        }
        if (isset($_POST['wphipercriativo_themeoptions_action_advanced'])&&wp_verify_nonce( sanitize_key($_POST['wphipercriativo_themeoptions_action_advanced']), -1 )) 
        {
           if (isset($_POST['advanced_css'])&&$_POST['advanced_css']!='') update_option('advanced_css', esc_html($_POST['advanced_css'])); if (isset($_POST['advanced_css'])&&$_POST['advanced_css']==''||!isset($_POST['advanced_css'])) delete_option('advanced_css');
           if (isset($_POST['advanced_js'])&&$_POST['advanced_js']!='') update_option('advanced_js', esc_html($_POST['advanced_js'])); if (isset($_POST['advanced_js'])&&$_POST['advanced_js']==''||!isset($_POST['advanced_js'])) delete_option('advanced_js');
        }
       $lang_menu_custom = get_option( 'lang_menu_custom' );
       $facebook_app_id = get_option( 'facebook_app_id' );
       $google_api_id = get_option( 'google_api_id' );
        
	   $body_background = get_option( 'body_background' );
	   $body_text = get_option( 'body_text' );
       $link_color = get_option( 'link_color'  );
       $hover_link_color = get_option( 'hover_link_color' );
       $header_link_color = get_option( 'header_link_color' );
       $header_hover_link_color = get_option( 'header_hover_link_color' );
       
       $header_logo = get_option( 'header_logo' );
       $alt_logo = get_option( 'alt_logo' );
       $shop_logo = get_option( 'shop_logo' );
       $mobile_logo = get_option( 'mobile_logo' );
       $favicon_logo = get_option( 'favicon_logo' );
       
       $facebook_link = get_option( 'facebook_link' );
       $twitter_link = get_option( 'twitter_link' );
       $instagram_link = get_option( 'instagram_link' );
       $pinterest_link = get_option( 'pinterest_link' );
       $behance_link = get_option( 'behance_link' );
       $linkedin_link = get_option( 'linkedin_link' );
       $googleplus_link = get_option( 'googleplus_link' );
       $youtube_link = get_option( 'youtube_link' );
       $vimeo_link = get_option( 'vimeo_link' );
       $flickr_link = get_option( 'flickr_link' );
       $xing_link = get_option( 'xing_link' );
       $dribbble_link = get_option( 'dribbble_link' );
       
       $header_style = get_option( 'header_style' );
       $social_menu = get_option( 'social_menu' );
       $show_toolbar = get_option( 'show_toolbar' );
       $fullscreen_nav = get_option( 'fullscreen_nav' );
       
       $footer_style = get_option( 'footer_style' );
       
       $advanced_css = get_option( 'advanced_css' );
       $advanced_js = get_option( 'advanced_js' );
       
       $theme_options_css='@charset "UTF-8";';
        if ( isset( $current_user->user_login ) && ! empty( $upload_dir['basedir'] ) )
        {
            if ( ! file_exists( $user_dirname ) ) { wp_mkdir_p( $user_dirname ); }
            $theme_options_css='@charset "UTF-8";';
            if(!empty($body_background))$theme_options_css .= 'body {background-color:'.$body_background.';}';
            if(!empty($body_text))$theme_options_css .= 'body {color:'.$body_text.';}';
            if(!empty($header_link_color))$theme_options_css .= 'header a:link {color:'.$header_link_color.';}';
            if(!empty($header_hover_link_color))$theme_options_css .= 'header a:hover, header a:focus, header a:active {color:'.$header_hover_link_color.';}';
            if(!empty($link_color))$theme_options_css .= 'a,a:link, a:active {color:'.$link_color.';}';
            if(!empty($hover_link_color))$theme_options_css .= 'a:hover, a:focus {color:'.$hover_link_color.';}';
            if(!empty($advanced_css))$theme_options_css .= wp_unslash($advanced_css);
            
            $file_write=false;
            //if(file_put_contents($user_dirname . $css_filename,$theme_options_css))$file_write=true;
            if(!$file_write){
                $creds = request_filesystem_credentials(site_url() . '/wp-admin/', '', false, false, array());
                if ( ! WP_Filesystem($creds) ) {
            		return false;
            	}	
                $wp_filesystem->put_contents(
                    $user_dirname . $css_filename,
                    $theme_options_css,
                    FS_CHMOD_FILE
                );
                $file_write=true;
            }
            if(!$file_write)
            {
                file_put_contents($user_dirname . $css_filename,$theme_options_css);
                $file_write=true;
            }
        }
       
	   echo '<div class="wrap"><div class="themeoptionspanel">';
        echo '<div class="container"><div class="row"><div class="col-xs-12"><h1>'.__('Theme Options','eletrico').'</h1><div><div><div class="row"><aside class="col-lg-3">';
        echo '<ul class="nav nav-tabs">';
        echo '<li class="active"><a data-toggle="tab" href="#_tab1"><span class="dashicons dashicons-admin-tools"></span> '.__('Settings','eletrico').'</a></li>';
        echo '<li><a data-toggle="tab" href="#_tab2"><span class="dashicons dashicons-admin-appearance"></span> '.__('Logo & Icons','eletrico').'</a></li>';
        echo '<li><a data-toggle="tab" href="#_tab3"><span class="dashicons dashicons-megaphone"></span> '.__('Social Networks','eletrico').'</a></li>';
        echo '<li><a data-toggle="tab" href="#_tab4"><span class="dashicons dashicons-laptop"></span> '.__('Styles','eletrico').'</a></li>';
        echo '<li><a data-toggle="tab" href="#_tab5"><span class="dashicons dashicons-editor-kitchensink"></span> '.__('Header','eletrico').'</a></li>';
        echo '<li><a data-toggle="tab" href="#_tab6"><span class="dashicons dashicons-media-document"></span> '.__('Content','eletrico').'</a></li>';
        echo '<li><a data-toggle="tab" href="#_tab_advanced"><span class="dashicons dashicons-editor-code"></span> '.__('Advanced','eletrico').'</a></li>';
        echo '</ul></aside>';
        
        echo '<div class="col-lg-9">';
        echo '<div class="tab-content">
          <div id="_tab1" class="tab-pane fade in active">
            <h2>Settings</h2>
            <h3>Theme settings and configuration</h3>
            <div class="container">
                <div class="row">';
                    include('forms/form-settings.php');
        echo '</div></div></div>';
        echo '<div id="_tab2" class="tab-pane fade">
            <h2>Logos</h2>
            <h3>Favicon and logos</h3>
            <div class="container"><div class="row">';
                    include('forms/form-logo.php');
        echo '</div></div></div>';
        echo '<div id="_tab3" class="tab-pane fade">
            <h2>Social</h2>
            <h3>Social Networks and Links</h3>
            <div class="container"><div class="row">';
                    include('forms/form-social.php');
        echo '</div></div></div>';
        echo '<div id="_tab4" class="tab-pane fade">
            <h2>Styles</h2>
            <h3>General page styles, colors and backgrounds</h3>
            <div class="container"><div class="row">';
                    include('forms/form-styles.php');
        echo '</div></div></div>';
        echo '<div id="_tab5" class="tab-pane fade">
            <h2>Header</h2>
            <h3>Header style & settings</h3>
            <div class="container"><div class="row">';
                    include('forms/form-header.php');
        echo '</div></div></div>';
        echo '<div id="_tab6" class="tab-pane fade">
            <h2>Content</h2>
            <h3>Content styles & settings</h3>
            <div class="container"><div class="row">';
                    //include('forms/form-social.php');
        echo '</div></div></div>';
        echo '<div id="_tab7" class="tab-pane fade">
            <h2>Footer</h2>
            <h3>Footer styles & settings</h3>
            <div class="container"><div class="row">';
                    include('forms/form-footer.php');
        echo '</div></div></div>';
        
         echo '<div id="_tab_advanced" class="tab-pane fade">
            <h2>Advanced</h2>
            <h3>Advanced code editor</h3>
            <div class="container"><div class="row">';
                    include('forms/form-advanced.php');
        echo '</div></div></div>';
          
        echo '</div>';
        echo '<div class="clear"></div></div></div></div>';//end cols
	   echo '</div></div><div class="clear"></div>';
       
       wp_enqueue_style('themebootstrapcss',get_template_directory_uri().'/framework/css/bootstrap.css');
       wp_enqueue_style('themecss',get_template_directory_uri().'/framework/css/themeoptions.css');
       wp_enqueue_style('themebootstrapcolorpickercss',get_template_directory_uri().'/framework/css/colorpicker.css');
       wp_enqueue_style('themetrumbowygcss',get_template_directory_uri().'/framework/css/trumbowyg.min.css');
       wp_enqueue_style('themefontawesomecss','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css');
       wp_enqueue_script('themebootstrapjs', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
       wp_enqueue_script('themebootstrapcolorpickerjs', get_template_directory_uri().'/framework/js/bootstrap-colorpicker.js');
       wp_enqueue_script('trumbowygjs', get_template_directory_uri().'/framework/js/trumbowyg.min.js');
       
       echo "<script>jQuery( document ).ready(function() {";
	   echo "jQuery('#body_background').colorpicker({setValue:'".$body_background."'});";
       //echo "jQuery('#body_text').val( '".$body_text."' );";
       echo "jQuery('#body_text').colorpicker({setValue:'".$body_text."'});";
      // echo "jQuery('#link_color').val( '".$link_color."' );";
	   echo "jQuery('#link_color').colorpicker({setValue:'".$link_color."'});";
      // echo "jQuery('#hover_link_color').val( '".$hover_link_color."' );";
	   echo "jQuery('#hover_link_color').colorpicker({setValue:'".$hover_link_color."'});";
	   echo "jQuery('#header_link_color').colorpicker({setValue:'".$header_link_color."'});";
	   echo "jQuery('#header_hover_link_color').colorpicker({setValue:'".$header_hover_link_color."'});";
       echo "});</script>";
       
       wp_enqueue_media();
       wp_enqueue_script('mediajs', get_template_directory_uri().'/framework/js/media.js');
	}
    
    function eletrico_themeoptions_styles_enqueue() {
        $upload_dir = wp_upload_dir();
        $user_dirname = $upload_dir['basedir'].'/eletrico/';
        $user_dirname_url = $upload_dir['baseurl'].'/eletrico/';
        $css_filename='themeoptions.css';
        
        if(file_exists($user_dirname.$css_filename)):
        wp_enqueue_style(
    		'themeoptions-style',
    		$user_dirname_url . '' . $css_filename
    	);
        endif;
    }
}
new ThemeOptions;