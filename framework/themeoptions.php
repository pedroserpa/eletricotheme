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
			),'',2
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
            if (isset($_POST['electrico_theme_options_settings'])) update_option('electrico_theme_options_settings', $_POST['electrico_theme_options_settings']); if (empty($_POST['electrico_theme_options_settings'])) delete_option('electrico_theme_options_settings');
        }
        if (isset($_POST['wphipercriativo_themeoptions_styles'])&&wp_verify_nonce( sanitize_key($_POST['wphipercriativo_themeoptions_styles']), -1 )) 
        {
            if (isset($_POST['electrico_theme_options_styles'])) update_option('electrico_theme_options_styles', $_POST['electrico_theme_options_styles']); if (empty($_POST['electrico_theme_options_styles'])) delete_option('electrico_theme_options_styles');
        }
    	if (isset($_POST['wphipercriativo_themeoptions_logos'])&&wp_verify_nonce( sanitize_key($_POST['wphipercriativo_themeoptions_logos']), -1 )) 
        {   
           if (isset($_POST['electrico_theme_options_logos'])) update_option('electrico_theme_options_logos', $_POST['electrico_theme_options_logos']); if (empty($_POST['electrico_theme_options_logos'])) delete_option('electrico_theme_options_logos');
        }
        if (isset($_POST['wphipercriativo_themeoptions_social'])&&wp_verify_nonce( sanitize_key($_POST['wphipercriativo_themeoptions_social']), -1 )) 
        {   
           if (isset($_POST['electrico_theme_options_social_links']) && $_POST['electrico_theme_options_social_links']!='') update_option('electrico_theme_options_social_links', $_POST['electrico_theme_options_social_links']); 
           if (empty($_POST['electrico_theme_options_social_links'])) delete_option('electrico_theme_options_social_links');
        }
        if (isset($_POST['wphipercriativo_themeoptions_header_styles'])&&wp_verify_nonce( sanitize_key($_POST['wphipercriativo_themeoptions_header_styles']), -1 )) 
        {
            if (isset($_POST['electrico_theme_options_header_styles'])) update_option('electrico_theme_options_header_styles', $_POST['electrico_theme_options_header_styles']); if (empty($_POST['electrico_theme_options_header_styles'])) delete_option('electrico_theme_options_header_styles');
        }
        if (isset($_POST['wphipercriativo_themeoptions_action_advanced'])&&wp_verify_nonce( sanitize_key($_POST['wphipercriativo_themeoptions_action_advanced']), -1 )) 
        {
           if (isset($_POST['electrico_advanced_css'])&&$_POST['electrico_advanced_css']!='') update_option('electrico_advanced_css', esc_html($_POST['electrico_advanced_css'])); if (isset($_POST['electrico_advanced_css'])&&$_POST['electrico_advanced_css']==''||!isset($_POST['electrico_advanced_css'])) delete_option('advanced_css');
           if (isset($_POST['electrico_advanced_js'])&&$_POST['electrico_advanced_js']!='') update_option('electrico_advanced_js', esc_html($_POST['electrico_advanced_js'])); if (isset($_POST['electrico_advanced_js'])&&$_POST['electrico_advanced_js']==''||!isset($_POST['electrico_advanced_js'])) delete_option('electrico_advanced_js');
        }
    $theme_settings=get_option('electrico_theme_options_settings',true);
       $lang_menu_custom = $theme_settings['lang_menu_custom'];
       $facebook_app_id = $theme_settings['facebook_app_id'];
       $google_api_id = $theme_settings['google_api_id'];
       $footer_style = $theme_settings['footer_style'];
       
	   $styles_options=get_option( 'electrico_theme_options_styles',true );
	   $header_toolbar_background_color = $styles_options['header_toolbar_background_color'];
	   $header_background_color = $styles_options['header_background_color'];
	   $footer_background_color = $styles_options['footer_background_color'];
	   
	   $body_background = $styles_options['body_background'];
	   $body_text = $styles_options['body_text'];
       $link_color = $styles_options['link_color'];
       $hover_link_color = $styles_options['hover_link_color'];
       $header_link_color = $styles_options['header_link_color'];
       $header_hover_link_color = $styles_options['header_hover_link_color'];
	   
	   $footer_text_color = $styles_options['footer_text_color'];
       $footer_link_color = $styles_options['footer_link_color'];
       
     $option_logos = get_option( 'electrico_theme_options_logos',true );
       $header_logo = $option_logos[ 'header_logo' ];
       $alt_logo = $option_logos[ 'alt_logo' ];
       $shop_logo = $option_logos[ 'shop_logo' ];
       $mobile_logo = $option_logos[ 'mobile_logo' ];
       $favicon_logo = $option_logos[ 'favicon_logo' ];
    
    $social_links=get_option('electrico_theme_options_social_links',true);   
       $facebook_link = $social_links[ 'facebook_link' ];
       $twitter_link = $social_links[ 'twitter_link' ];
       $instagram_link = $social_links[ 'instagram_link' ];
       $pinterest_link = $social_links[ 'pinterest_link' ];
       $behance_link = $social_links[ 'behance_link' ];
       $linkedin_link = $social_links[ 'linkedin_link' ];
       $googleplus_link = $social_links[ 'googleplus_link' ];
       $youtube_link = $social_links[ 'youtube_link' ];
       $vimeo_link = $social_links[ 'vimeo_link' ];
       $flickr_link = $social_links[ 'flickr_link' ];
       $xing_link = $social_links[ 'xing_link' ];
       $dribbble_link = $social_links[ 'dribbble_link' ];
    
    $header_styles=get_option('electrico_theme_options_header_styles',true);
       $header_style = $header_styles[ 'header_style' ];
       $full_width_header_style = $header_styles[ 'full_width_header_style' ];
       $social_menu = $header_styles[ 'social_menu' ];
       $show_toolbar = $header_styles[ 'show_toolbar' ];
       $fullscreen_nav = $header_styles[ 'fullscreen_nav' ];
       
       $advanced_css = get_option( 'electrico_advanced_css' );
       $advanced_js = get_option( 'electrico_advanced_js' );
       
       $theme_options_css='@charset "UTF-8";';
        if ( isset( $current_user->user_login ) && ! empty( $upload_dir['basedir'] ) )
        {
            if ( ! file_exists( $user_dirname ) ) { wp_mkdir_p( $user_dirname ); }
            $theme_options_css='@charset "UTF-8";';
            if(!empty($header_toolbar_background_color))$theme_options_css .= 'header .toolbar {background-color:'.$header_toolbar_background_color.';}';
            if(!empty($header_background_color))$theme_options_css .= 'header {background-color:'.$header_background_color.';}';
            if(!empty($footer_background_color))$theme_options_css .= 'footer {background-color:'.$footer_background_color.';}';
			
            if(!empty($body_background))$theme_options_css .= 'body {background-color:'.$body_background.';}';
            if(!empty($body_text))$theme_options_css .= 'body {color:'.$body_text.';}';
            if(!empty($header_link_color))$theme_options_css .= 'header a,header a:link {color:'.$header_link_color.';}';
            if(!empty($header_hover_link_color))$theme_options_css .= 'header a:hover, header a:focus, header a:active {color:'.$header_hover_link_color.';}';
            if(!empty($link_color))$theme_options_css .= 'body a,a:link, a:active, .slicks-slider a {color:'.$link_color.';}';
            if(!empty($hover_link_color))$theme_options_css .= 'a:hover, a:focus {color:'.$hover_link_color.';}';
			if(!empty($footer_text_color))$theme_options_css .= 'footer,footer .col, footer p {color:'.$footer_text_color.';}';
			if(!empty($footer_link_color))$theme_options_css .= 'footer a, footer a:link {color:'.$footer_link_color.';}';
			
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
	   echo "jQuery('#header_toolbar_background_color').colorpicker({setValue:'".$header_toolbar_background_color."'});";
	   echo "jQuery('#header_background_color').colorpicker({setValue:'".$header_background_color."'});";
	   echo "jQuery('#footer_background_color').colorpicker({setValue:'".$footer_background_color."'});";
	   
	   echo "jQuery('#body_background').colorpicker({setValue:'".$body_background."'});";
       //echo "jQuery('#body_text').val( '".$body_text."' );";
       echo "jQuery('#body_text').colorpicker({setValue:'".$body_text."'});";
      // echo "jQuery('#link_color').val( '".$link_color."' );";
	   echo "jQuery('#link_color').colorpicker({setValue:'".$link_color."'});";
      // echo "jQuery('#hover_link_color').val( '".$hover_link_color."' );";
	   echo "jQuery('#hover_link_color').colorpicker({setValue:'".$hover_link_color."'});";
	   echo "jQuery('#header_link_color').colorpicker({setValue:'".$header_link_color."'});";
	   echo "jQuery('#header_hover_link_color').colorpicker({setValue:'".$header_hover_link_color."'});";
	   
	   echo "jQuery('#footer_text_color').colorpicker({setValue:'".$footer_text_color."'});";
	   echo "jQuery('#footer_link_color').colorpicker({setValue:'".$footer_link_color."'});";
	   
	   echo "jQuery('.tab-pane input[type=checkbox]').on('change',function(){";
		   echo "var _this=jQuery(this);";
		   echo "if( _this.is(':checked') )_this.val(1);";
		   echo "else _this.val(0);";
		   echo "return false;";
	   echo "});";
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