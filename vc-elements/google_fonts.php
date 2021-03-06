<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class Eletrico_vc_custom_google_fonts /*extends WPBakeryShortCode*/ {
	/**
	 * @param $atts
	 *
	 * @return mixed|void
	 */
	public $style;
	public function __construct( $atts ) {
		$fontsData = $this->getFontsData( $atts,'google_fonts' );
		$this->enqueueGoogleFonts( $fontsData );
		$googleFontsStyles = $this->googleFontsStyles( $fontsData );
		$this->style = ( $googleFontsStyles  );
		//$style = esc_attr( $googleFontsStyles  );
		/*$template = <<<HTML
		<h2 style="$style">$content</h2>
HTML;*/
		return $this->style;
	}

	protected function getFontsData( $atts,$paramName ) {
		$googleFontsParam = new Vc_Google_Fonts();
		$field = WPBMap::getParam( $this->shortcode, $atts[$paramName] );
		$fieldSettings = isset( $field['settings'], $field['settings']['fields'] ) ? $field['settings']['fields'] : array();
		$fontsData = strlen( $atts[$paramName] ) > 0 ? $googleFontsParam->_vc_google_fonts_parse_attributes( $fieldSettings, $atts[$paramName] ) : '';

		return $fontsData;
	}

	protected function googleFontsStyles( $fontsData ) {
		// Inline styles
		$fontFamily = explode( ':', $fontsData['values']['font_family'] );
		$styles[] = 'font-family:' . $fontFamily[0];
		$fontStyles = explode( ':', $fontsData['values']['font_style'] );
		$styles[] = 'font-weight:' . $fontStyles[1];
		$styles[] = 'font-style:' . $fontStyles[2];

		return $styles;
	}

	protected function enqueueGoogleFonts( $fontsData ) {
		// Get extra subsets for settings (latin/cyrillic/etc)
		$settings = get_option( 'wpb_js_google_fonts_subsets' );
		if ( is_array( $settings ) && ! empty( $settings ) ) {
			$subsets = '&subset=' . implode( ',', $settings );
		} else {
			$subsets = '';
		}

		// We also need to enqueue font from googleapis
		if ( isset( $fontsData['values']['font_family'] ) ) {
			wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $fontsData['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $fontsData['values']['font_family'] . $subsets );
		}
	}
}