<?php
/**
 * Eléctrico Theme: Customizer
 *
 * @package WordPress
 * @subpackage Eléctrico Theme
 * @since 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function electrico_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'electrico_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'electrico_customize_partial_blogdescription',
	) );

	/**
	 * Custom colors.
	 */
	$wp_customize->add_control( 'colorscheme', array(
		'type'    => 'radio',
		'label'    => __( 'Color Scheme', 'electrico' ),
		'choices'  => array(
			'light'  => __( 'Light', 'electrico' ),
			'dark'   => __( 'Dark', 'electrico' ),
			'custom' => __( 'Custom', 'electrico' ),
		),
		'section'  => 'colors',
		'priority' => 5,
	) );
}
add_action( 'customize_register', 'electrico_customize_register' );

/**
 * Sanitize the colorscheme.
 *
 * @param string $input Color scheme.
 */
function electrico_sanitize_colorscheme( $input ) {
	$valid = array( 'light', 'dark', 'custom' );

	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'light';
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Eléctrico Theme 1.0
 * @see electrico_customize_register()
 *
 * @return void
 */
function electrico_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Eléctrico Theme 1.0
 * @see electrico_customize_register()
 *
 * @return void
 */
function electrico_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Return whether we're previewing the front page and it's a static page.
 */
function electrico_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Return whether we're on a view that supports a one or two column layout.
 */
function electrico_is_view_with_layout_option() {
	// This option is available on all pages. It's also available on archives when there isn't a sidebar.
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'sidebar-1' ) ) );
}

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function electrico_customize_preview_js() {
	wp_enqueue_script( 'electrico-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'electrico_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function electrico_panels_js() {
	wp_enqueue_script( 'electrico-customize-controls', get_theme_file_uri( '/assets/js/customize-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'electrico_panels_js' );
