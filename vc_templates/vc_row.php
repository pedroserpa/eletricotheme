<?php
$output = $el_id = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $min_height = $css = $custom_css=$responsive_visibility='';
extract(shortcode_atts(array(
    'el_class'        => '',
    'el_id'=>'',
    'bg_color'        => '',
    'font_color'      => '',
    'padding'         => '',
    'full_width'      => '',
    'margin_bottom'   => '0',
    'min_height'      => '10',
    'responsive_visibility' => '',
    'css' => ''
), $atts));
 
// wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
// wp_enqueue_style('js_composer_custom_css');
 
$el_class = $this->getExtraClass($el_class);

if ( !empty( $el_id ) ) {
    $component_id=$el_id=$el_id;
}else{
$el_id=$component_id='vc-row-'.uniqid();
}
        
if(!empty($min_height)){
    $custom_css.='#'.$component_id.' {min-height:'.intval($min_height).'px;}';
}
if(!empty($responsive_visibility)){
    $responsive_class=$responsive_visibility;
}
wp_register_style( 'electrico-style-css', false );
wp_enqueue_style( 'electrico-style-css' );
wp_add_inline_style( 'electrico-style-css', $custom_css );
 
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row '. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class .' '. $responsive_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
if(!empty($full_width)&&$full_width=='true'){
    $css_class.=' vc_row-fluid';
}
else {
    $css_class.=' vc_row-boxed ';
}
if ( ! empty( $gap ) ) {
	$css_class .= ' vc_column-gap-' . $gap;
}
$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);
$output .= '<div id="'.$component_id.'" class="'.$css_class.'" '.$style.'>';
$output .= wpb_js_remove_wpautop($content);
$output .= '</div>'.$this->endBlockComment('row');
 
echo $output;