<?php
/**
 * Elétrico functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Elétrico
 * @since 1.0
 */

/**
 * Elétrico only works in WordPress 4.7 or later.
 */
if(file_exists(get_template_directory().'/framework/bfi_thumb/BFI_Thumb.php'))require_once(get_template_directory().'/framework/bfi_thumb/BFI_Thumb.php');
if( ! class_exists( 'Hipercriativo_Electrico' ) ) {
  class Hipercriativo_Electrico {
    
    public function __construct() {
		if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
			add_action( 'admin_notices', array($this,'electrico_upgrade_notice') );
			return;
		}
		add_action( 'after_setup_theme', array($this,'electrico_setup') );
		add_action( 'wp_head', array($this,'electrico_pingback_header') );
		add_action( 'wp_head', array($this,'electrico_javascript_detection'), 0 );
		if(!is_admin())add_action( 'wp_enqueue_scripts', array($this,'electrico_scripts') );
		add_filter( 'wp_resource_hints', array($this,'electrico_resource_hints'), 10, 2 );
		add_filter( 'wp_calculate_image_sizes', array($this,'electrico_content_image_sizes_attr'), 10, 2 );
		add_filter( 'wp_get_attachment_image_attributes', array($this,'electrico_post_thumbnail_sizes_attr'), 10, 3 );
			//add_filter( 'excerpt_more', array($this,'electrico_excerpt_more') );
		
		add_action( 'show_user_profile', array($this,'extra_user_profile_fields') );
		add_action( 'edit_user_profile', array($this,'extra_user_profile_fields') );
		add_action( 'personal_options_update', array($this,'save_extra_user_profile_fields') );
		add_action( 'edit_user_profile_update', array($this,'save_extra_user_profile_fields') );
		add_action( 'show_user_profile', array($this,'extra_user_profile_fields') );
		add_action( 'edit_user_profile', array($this,'extra_user_profile_fields') );
		
		add_action( 'login_enqueue_scripts', array($this,'electrico_login_logo') );
		add_filter( 'login_headerurl', array($this,'electrico_login_logo_url') );
		add_filter( 'login_headertext', array($this,'electrico_login_logo_url_title') );

		add_action( 'after_setup_theme', array($this,'after_electrico_install') );

		add_filter( 'body_class', array($this,'electrico_body_class') );
		
		//post types
		if(file_exists(get_template_directory() . '/framework/posttypes.php'))include(get_template_directory() . '/framework/posttypes.php');
		if(file_exists(get_template_directory() . '/framework/posttypestaxonomy.php'))include(get_template_directory() . '/framework/posttypestaxonomy.php');

		//VC Integration
		if( in_array('js_composer_theme/js_composer.php', apply_filters('active_plugins', get_option('active_plugins'))) ){ 
			if(is_admin())add_action( 'admin_enqueue_scripts', array($this,'electrico_admin_scripts') );
			add_action( 'vc_before_init', array($this,'vc_before_init_actions') );
			add_action( 'vc_after_init', array($this,'vc_after_init_actions') );
		}
    }
	public function electrico_upgrade_notice() {
		$message = sprintf( __( 'Elétrico Theme requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'eletrico' ), $GLOBALS['wp_version'] );
		printf( '<div class="error"><p>%s</p></div>', $message );
	}

	public function electrico_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/electrico
		 * If you're building a theme based on Elétrico, use a find and replace
		 * to change 'eletrico' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'eletrico' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'electrico-featured-image', 2000, 1200, true );

		add_image_size( 'electrico-thumbnail-avatar', 100, 100, true );

		// Set the default content width.
		$GLOBALS['content_width'] = 1140;

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'toolbar'    => __( 'Toolbar Menu', 'electrico' ),
			'top'    => __( 'Top Menu', 'electrico' ),
			'fullscreen'    => __( 'Fullscreen Menu', 'electrico' ),
			'shop_menu' => __( 'Shop Menu', 'electrico' ),
			'footer_menu' => __( 'Footer Menu', 'electrico' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		) );

		// Add theme support for Custom Logo.
		add_theme_support( 'custom-logo', array(
			'width'       => 320,
			'height'      => 220,
			'flex-width'  => true,
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, and column width.
		 */
		//add_editor_style( array( 'assets/css/editor-style.css', array($this,'eletrico_fonts_url') ) );

		// Define and register starter content to showcase the theme on new sites.
		$starter_content = array(
			'widgets' => array(
				// Place three core-defined widgets in the sidebar area.
				'sidebar-1' => array(
					'text_business_info',
					'search',
					'text_about',
				),

				// Add the core-defined business info widget to the footer 1 area.
				'sidebar-2' => array(
					'text_business_info',
				),

				// Put two core-defined widgets in the footer 2 area.
				'sidebar-3' => array(
					'text_about',
					'search',
				),
				// Put two core-defined widgets in the footer 2 area.
				'sidebar-4' => array(
					'text',
				),
				// Put two core-defined widgets in the footer 2 area.
				'sidebar-5' => array(
					'text',
				),
				'sidebar-6' => array(
					'text',
				),
			),

			// Default to a static front page and assign the front and posts pages.
			'options' => array(
				'show_on_front' => 'page',
				'page_on_front' => '{{home}}',
				'page_for_posts' => '{{blog}}',
			),

			// Set up nav menus for each of the two areas registered in the theme.
			'nav_menus' => array(
				// Assign a menu to the "top" location.
				'top' => array(
					'name' => __( 'Top Menu', 'electrico' ),
					'items' => array(
						'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
						'page_about',
						'page_blog',
						'page_contact',
					),
				),

				// Assign a menu to the "social" location.
				/*'shop_menu' => array(
					'name' => __( 'Shop Menu', 'electrico' ),
					'items' => array(
						'link_facebook',
						'link_twitter',
						'link_instagram',
						'link_email',
					),
				),*/
			),
		);


		if(file_exists(get_template_directory() . '/framework/themeoptions.php'))include(get_template_directory() . '/framework/themeoptions.php');
		if(file_exists(get_template_directory().'/framework/widgets.php'))require_once(get_template_directory().'/framework/widgets.php');
		/**
		 * Filters Elétrico array of starter content.
		 *
		 * @since Elétrico 1.1
		 *
		 * @param array $starter_content Array of starter content.
		 */
		$starter_content = apply_filters( 'electrico_starter_content', $starter_content );

		add_theme_support( 'starter-content', $starter_content );
	}
	/**
	 * Register custom fonts.
	 */
	public function eletrico_fonts_url() {

		/*
		 * Translators: If there are characters in your language that are not
		 * supported by Raleway, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$fonts_url = '';
		$gfont = _x( 'on', 'Open Sans font: on or off', 'eletrico' );
		if ( 'off' !== $gfont ) {
			$font_families = array();

			$font_families[] = 'Open Sans:300,400,600,700';

			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);

			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
	}
	/**
	 * Add preconnect for Google Fonts.
	 *
	 * @since Elétrico 1.0
	 *
	 * @param array  $urls           URLs to print for resource hints.
	 * @param string $relation_type  The relation type the URLs are printed.
	 * @return array $urls           URLs to print for resource hints.
	 */
	public function electrico_resource_hints( $urls, $relation_type ) {
		if ( wp_style_is( 'electrico-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		}

		return $urls;
	}


	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
	 * a 'Continue reading' link.
	 *
	 * @since Elétrico 1.0
	 *
	 * @param string $link Link to single post/page.
	 * @return string 'Continue reading' link prepended with an ellipsis.
	 */
	public function electrico_excerpt_more( $link ) {
		if ( is_admin() ) {
			return $link;
		}

		$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
			esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'electrico' ), get_the_title( get_the_ID() ) )
		);
		return ' &hellip; ' . $link;
	}
	/**
	 * Handles JavaScript detection.
	 *
	 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
	 *
	 * @since Elétrico 1.0
	 */
	public function electrico_javascript_detection() {
		echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
	}
	/**
	 * Add a pingback url auto-discovery header for singularly identifiable articles.
	 */
	public function electrico_pingback_header() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
		}
	}


	/**
	 * Display custom color CSS.

	function electrico_colors_css_wrap() {
		if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
			return;
		}

		require_once( get_parent_theme_file_path( '/inc/color-patterns.php' ) );
		$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );
	?>
		<style type="text/css" id="custom-theme-colors" <?php if ( is_customize_preview() ) { echo 'data-hue="' . $hue . '"'; } ?>>
			<?php echo electrico_custom_colors_css(); ?>
		</style>
	<?php }
	add_action( 'wp_head', 'electrico_colors_css_wrap' ); */

	/**
	 * Enqueue scripts and styles.
	 */
	function electrico_scripts() {
		// Add custom fonts, used in the main stylesheet.
		wp_enqueue_style( 'electrico-fonts', $this->eletrico_fonts_url() );

		// Theme stylesheet.
		wp_enqueue_style( 'bootstrap-style', get_template_directory_uri().'/assets/css/bootstrap.css' );
		wp_enqueue_style( 'fontawesome-style', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
		wp_enqueue_style( 'electrico-style', get_template_directory_uri().'/assets/css/style.css' );
		wp_enqueue_style( 'slick-style', get_template_directory_uri().'/assets/css/slick.css' );
		wp_enqueue_style( 'slick-style-theme', get_template_directory_uri().'/assets/css/slick-theme.css' );

		
		wp_enqueue_script( 'electrico-boostrapjs', get_theme_file_uri( '/assets/js/bootstrap.min.js' ), array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'slick-js', get_theme_file_uri( '/assets/js/slick.min.js' ), array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'electrico-masonry', get_theme_file_uri( '/assets/js/masonry.min.js' ), array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'electrico-main', get_theme_file_uri( '/assets/js/main.js' ), array( 'jquery' ), '1.0', true );
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	/**
	 * Add custom image sizes attribute to enhance responsive image functionality
	 * for content images.
	 *
	 * @since Elétrico 1.0
	 *
	 * @param string $sizes A source size value for use in a 'sizes' attribute.
	 * @param array  $size  Image size. Accepts an array of width and height
	 *                      values in pixels (in that order).
	 * @return string A source size value for use in a content image 'sizes' attribute.
	 */
	public function electrico_content_image_sizes_attr( $sizes, $size ) {
		$width = $size[0];
		$sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		return $sizes;
	}
	/**
	 * Add custom image sizes attribute to enhance responsive image functionality
	 * for post thumbnails.
	 *
	 * @since Elétrico 1.0
	 *
	 * @param array $attr       Attributes for the image markup.
	 * @param int   $attachment Image attachment ID.
	 * @param array $size       Registered image size or flat array of height and width dimensions.
	 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
	 */
	public function electrico_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
		if ( is_archive() || is_search() || is_home() ) {
			$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		} else {
			$attr['sizes'] = '100vw';
		}
		return $attr;
	}
	

/**
 * Custom template tags for this theme.
 */
//require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Customizer additions.
 */
//require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * SVG icons functions and filters.
 */
//require get_parent_theme_file_path( '/inc/icon-functions.php' );


	public function extra_user_profile_fields( $user ) { ?>
		<h3><?php _e("Extra profile information", "blank"); ?></h3>
		<table class="form-table">
		<tr>
			<th><label for="address"><?php _e("Address"); ?></label></th>
			<td>
				<input type="text" name="address" id="address" value="<?php echo esc_attr( get_the_author_meta( 'address', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e("Please enter your address."); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="city"><?php _e("City"); ?></label></th>
			<td>
				<input type="text" name="city" id="city" value="<?php echo esc_attr( get_the_author_meta( 'city', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e("Please enter your city."); ?></span>
			</td>
		</tr>
		<tr>
		<th><label for="postalcode"><?php _e("Postal Code"); ?></label></th>
			<td>
				<input type="text" name="postalcode" id="postalcode" value="<?php echo esc_attr( get_the_author_meta( 'postalcode', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e("Please enter your postal code."); ?></span>
			</td>
		</tr>
		<tr>
		<th><label for="phone"><?php _e("Phone"); ?></label></th>
			<td>
				<input type="text" name="phone" id="phone" value="<?php echo esc_attr( get_the_author_meta( 'phone', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e("Please enter your phone number."); ?></span>
			</td>
		</tr>
		</table>
	<?php 
	}
	public function save_extra_user_profile_fields( $user_id ) {
		if ( !current_user_can( 'edit_user', $user_id ) ) { 
			return false; 
		}
		update_user_meta( $user_id, 'address', $_POST['address'] );
		update_user_meta( $user_id, 'city', $_POST['city'] );
		update_user_meta( $user_id, 'postalcode', $_POST['postalcode'] );
		update_user_meta( $user_id, 'phone', $_POST['phone'] );
	}
	public function electrico_login_logo() { ?>
		<style type="text/css">
			#login h1 a, .login h1 a {
			background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/logo.png);
			width:200px;
			height:100px;
			background-size:100%;
			background-repeat: no-repeat;
			padding-bottom: 2px;
			outline:0;
			border:0;
			text-decoration:none;
			}
		</style>
	<?php 
	}
	public function electrico_login_logo_url() {
		return home_url();
	}
	public function electrico_login_logo_url_title() {
		$title_site=get_bloginfo('name');
		if(!$title_site)$title_site='Elétrico Theme';
		return $title_site;
	}
	public function after_electrico_install() {
		add_theme_support( 'woocommerce' );
		add_image_size('square_thumbs',640,640,true);
		add_image_size('16_9_large',1920,962,true);
		add_image_size('16_9_thumbs',1280,720,true);
		add_image_size('9_16_thumbs',720,1280,true);
		
		add_image_size('16_3_thumbs',1534,475,true);
		//add_image_size('5_10_thumbs',766,869,true);
		add_image_size('5_10_thumbs',766,952,true);
	}
	public function electrico_body_class($classes)
	{
		global $post;
		if(is_page()):
			return array_merge( $classes, array( 'page-'.$post->post_name ) );
		endif;
		return ;
	}
	/**
	VC INTEGRATION
	**/
	public function electrico_admin_scripts() {
		wp_register_style( 'vc_extend_css', get_template_directory_uri() . '/assets/css/vc_extend.css', false, '1.0.0'  );
		wp_enqueue_style( 'vc_extend_css' );
	}
    public function numberfield_param_settings( $settings, $value ) {
       return '<div class="number_param_block">'
                 .'<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' .
                 esc_attr( $settings['param_name'] ) . ' ' .
                 esc_attr( $settings['type'] ) . '_field" type="number"
                 '.(($settings['min'])?' min="'.$settings['min'].'" ':' ').'  
                 '.(($settings['max'])?' max="'.$settings['max'].'" ':' ').'  
                 value="' . esc_attr( $value ) . '" />' .
                 '</div>';
    }
    public function vc_before_init_actions() {
        vc_add_shortcode_param( 'numberfield', array($this,'numberfield_param_settings') );
        
        //if( function_exists('vc_set_shortcodes_templates_dir') ){
        vc_set_shortcodes_templates_dir( get_template_directory() . '/vc_templates' );
        //}
    
        if(file_exists(get_template_directory().'/vc-elements/big_slick/big_slick.php'))require_once( get_template_directory().'/vc-elements/big_slick/big_slick.php' );
        if(file_exists(get_template_directory().'/vc-elements/el_accordion/el_accordion.php'))require_once( get_template_directory().'/vc-elements/el_accordion/el_accordion.php' );
        if(file_exists(get_template_directory().'/vc-elements/el_vw_image/el_vw_image.php'))require_once( get_template_directory().'/vc-elements/el_vw_image/el_vw_image.php' );
        if(file_exists(get_template_directory().'/vc-elements/el_carousel/el_carousel.php'))require_once( get_template_directory().'/vc-elements/el_carousel/el_carousel.php' );
        if(file_exists(get_template_directory().'/vc-elements/el_padding/el_padding.php'))require_once( get_template_directory().'/vc-elements/el_padding/el_padding.php' ); 
        if(file_exists(get_template_directory().'/vc-elements/el_scalable_padding/el_scalable_padding.php'))require_once( get_template_directory().'/vc-elements/el_scalable_padding/el_scalable_padding.php' ); 
        if(file_exists(get_template_directory().'/vc-elements/el_advbutton/el_advbutton.php'))require_once( get_template_directory().'/vc-elements/el_advbutton/el_advbutton.php' );
        if(file_exists(get_template_directory().'/vc-elements/el_media_contentbox/el_media_contentbox.php'))require_once( get_template_directory().'/vc-elements/el_media_contentbox/el_media_contentbox.php' );
        if(file_exists(get_template_directory().'/vc-elements/el_content_slider/el_content_slider.php'))require_once( get_template_directory().'/vc-elements/el_content_slider/el_content_slider.php' );
        if(file_exists(get_template_directory().'/vc-elements/el_mosaic/el_mosaic.php'))require_once( get_template_directory().'/vc-elements/el_mosaic/el_mosaic.php' );
        if(file_exists(get_template_directory().'/vc-elements/el_folio_mosaic/el_foliomosaic.php'))require_once( get_template_directory().'/vc-elements/el_folio_mosaic/el_foliomosaic.php' );
        if(file_exists(get_template_directory().'/vc-elements/el_video_mosaic/el_videomosaic.php'))require_once( get_template_directory().'/vc-elements/el_video_mosaic/el_videomosaic.php' );
        if(file_exists(get_template_directory().'/vc-elements/el_fancy_heading/el_fancy_heading.php'))require_once( get_template_directory().'/vc-elements/el_fancy_heading/el_fancy_heading.php' );
        if(file_exists(get_template_directory().'/vc-elements/el_contentbox/el_contentbox.php'))require_once( get_template_directory().'/vc-elements/el_contentbox/el_contentbox.php' );
		
		//if(file_exists(get_template_directory().'/vc-elements/el_custom_box/el_custom_box.php'))require_once( get_template_directory().'/vc-elements/el_custom_box/el_custom_box.php' );
		
        
    }
    public function vc_after_init_actions() {
        $row_attributes=array(
        array(
            'type' => 'checkbox',
            'heading' => "Full width row?",
            'param_name' => 'full_width',
            'value' => 'false',
            "weight"=>1
        ),
        array(
            'type' => 'numberfield',
            'heading' => "Minimum Height (Px)",
            'param_name' => 'min_height',
            'value' => "10",
            "weight"=>1
        ),
        array(
            'type' => 'checkbox',
            'heading' => "Add background mask?",
            'param_name' => 'background_mask_add',
            'value' => 'false',
            "weight"=>1
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Background Mask", "hipercriativo"),
            "param_name" => "background_mask",
            "value" => "",
            "dependency" => array(
                "element" => "background_mask_add",
                "value" => 'true'
            ),
            "weight"=>1
        ),
        array(
            'type' => 'dropdown',
            'heading' => "Responsive visibility",
            'param_name' => 'responsive_visibility',
            'value' =>
            array(
                    'Visible On All'   => '',
                    'Visible on large devices'   => 'hidden-lg-up',
                    'Visible on medium&large devices' => 'hidden-md-up',
                    'Visible on extra small devices' => 'hidden-sm-up',
                    'Hidden on large devices'   => 'hidden-lg-up',
                    'Hidden on medium&large devices' => 'hidden-md-up',
                    'Hidden on small devices' => 'hidden-sm-down',
                    'Hidden on extra small devices' => 'hidden-xs-down',
            ),
            "weight"=>1
        )
        );
        $col_attributes=array(
        array(
            'type' => 'numberfield',
            'heading' => "Minimum Height (Px)",
            'param_name' => 'min_height',
            'value' => "10",
            "weight"=>1
        ),
        array(
            'type' => 'checkbox',
            'heading' => "Add background mask?",
            'param_name' => 'background_mask_add',
            'value' => 'false',
            "weight"=>1
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Background Mask", "hipercriativo"),
            "param_name" => "background_mask",
            "value" => "",
            "dependency" => array(
                "element" => "background_mask_add",
                "value" => 'true'
            ),
            "weight"=>1
        ),
        array(
            'type' => 'dropdown',
            'heading' => "Responsive visibility",
            'param_name' => 'responsive_visibility',
            'value' =>
            array(
                    'Visible On All'   => '',
                    'Visible on large devices'   => 'hidden-lg-up',
                    'Visible on medium&large devices' => 'hidden-md-up',
                    'Visible on extra small devices' => 'hidden-sm-up',
                    'Hidden on large devices'   => 'hidden-lg-up',
                    'Hidden on medium&large devices' => 'hidden-md-up',
                    'Hidden on small devices' => 'hidden-sm-down',
                    'Hidden on extra small devices' => 'hidden-xs-down',
            ),
            "weight"=>1
        )
        );
		$gmaps_attributes=array(
			array(
				'type' => 'checkbox',
				'heading' => "Show Google Map?",
				'param_name' => 'gmap_show',
				'value' => 'false',
				"weight"=>12
			),
			array(
				'type' => 'textfield',
				'heading' => "Google Map Link",
				'param_name' => 'gmap_link',
				'value' => '',
				"weight"=>13,
				"dependency" => array(
					"element" => "gmap_show",
					"value" => "true"
				)
			),
		);
        vc_add_params( 'vc_row', $row_attributes );
        vc_add_params( 'vc_row_inner', $row_attributes );
        vc_add_params( 'vc_column', $col_attributes );
        vc_add_params( 'vc_column_inner', $col_attributes );
        vc_add_params( 'vc_section', $gmaps_attributes );
		if(file_exists(get_template_directory().'/vc-elements/google_fonts.php')){
			require_once(get_template_directory().'/vc-elements/google_fonts.php');
			//vc_lean_map( 'vc_custom_google_fonts', null, get_template_directory() . '/vc-elements/el_fancy_heading/el_fancy_heading.php' );
		}
		
    }
	public function getVideoID($video_url)
	{
		if(!$video_url)return false;
		$video_id=str_replace('https://www.youtube.com/watch?v=','',$video_url);
		if($video_id):
			return $video_id;
		endif;
		return false;
	}
  }
	$Hipercriativo_Electrico=new Hipercriativo_Electrico();
}