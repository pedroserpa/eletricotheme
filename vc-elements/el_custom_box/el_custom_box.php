<?php
/*
Element Description: Media Content Box
*/
 
// Element Class
if ( class_exists( 'WPBakeryShortCodes' ) ) {
class customBox extends WPBakeryShortCodesContainer {
    function __construct() {
        add_action( 'vc_after_init', array( $this, 'custom_box_mapping' ) );
        add_shortcode( 'el_customboxcontainer', array( $this, 'custom_box_html' ) );
    }
     
    // Element Mapping
    public function custom_box_mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
        vc_map( 
            array(
                'name' => __('Custom Box', 'hipercriativo'),
                'base' => 'el_customboxcontainer',
				"as_parent" => array(
					'except' => 'vc_section'
				),
				/*'html_template' => dirname( __FILE__ ) . '/template.php',*/
				"content_element" => true,
				"is_container"=>true,
				/*"show_settings_on_create" => false,*/
				"description" => __("Custom Box For your contents.", "mk_framework") ,
				//"as_parent" => array('only' => 'vc_custom_heading,vc_column_text,adv_button,vc_single_image,el_vw_image,el_padding'),
                'icon' => 'icon-el_customboxcontainer vc_mk_element-icon',
                'params' => array(
					array(
						"type" => "numberfield",
						"heading" => __("Corner Radius", "mk_framework") ,
						"param_name" => "corner_radius",
						"value" => "0",
						"min" => "0",
						"max" => "50",
						"step" => "1",
						"description" => __("", "mk_framework")
					) ,
					array(
						"type" => "numberfield",
						"heading" => __("Padding Top and Bottom", "mk_framework") ,
						"param_name" => "padding_vertical",
						"value" => "30",
						"min" => "0",
						"max" => "200",
						"step" => "1",
						"description" => __("", "mk_framework")
					) ,
					array(
						"type" => "numberfield",
						"heading" => __("Padding Left and Right", "mk_framework") ,
						"param_name" => "padding_horizontal",
						"value" => "20",
						"min" => "0",
						"max" => "200",
						"step" => "1",
						"description" => __("", "mk_framework")
					) ,
					array(
						"type" => "numberfield",
						"heading" => __("Margin Bottom", "mk_framework") ,
						"param_name" => "margin_bottom",
						"value" => "10",
						"min" => "0",
						"max" => "200",
						"step" => "1",
						"description" => __("", "mk_framework")
					) ,
					array(
						"type" => "numberfield",
						"heading" => __("Section Min Height", "mk_framework") ,
						"param_name" => "min_height",
						"value" => "100",
						"min" => "0",
						"max" => "1000",
						"step" => "1",
						"unit" => 'px',
						"description" => __("", "mk_framework")
					) ,
					array(
						"type" => "textfield",
						"heading" => __("Extra class name", "hipercriativo"),
						"param_name" => "el_class",
						"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "hipercriativo")
					)
				),
				'js_view' => 'VcColumnView'                
                        
                
            )
        );       
    }
     
    public function custom_box_html( $atts,$content=null ) {
        global $wpdb;
        extract(
            shortcode_atts(
                array(
				'corner_radius'							=> 0,
				'padding_horizontal' 					=> '20',
				'padding_vertical' 						=> '30',
				'min_height' 							=> '100',
				'margin_bottom' 						=> '10',
                'el_class'   => ''
                ), 
                $atts
            )
        );
		$content=wpb_js_remove_wpautop( $content );
        
        $component_id='vc-customboxcontainer-'.uniqid();
        $custom_css='';
		if(!empty($corner_radius)){
			$custom_css.='#'.$component_id.'{border-radius:'.$corner_radius.'px;}';
		}
		if(!empty($padding_horizontal)){
			$custom_css.='#'.$component_id.'{padding-right:'.$padding_horizontal.'px;padding-left:'.$padding_horizontal.'px;}';
		}
		if(!empty($padding_vertical)){
			$custom_css.='#'.$component_id.'{padding-top:'.$padding_vertical.'px;padding-bottom:'.$padding_vertical.'px;}';
		}
		if(!empty($min_height)){
			$custom_css.='#'.$component_id.'{min-height:'.$min_height.'px;}';
		}
		if(!empty($margin_bottom)){
			$custom_css.='#'.$component_id.'{padding-bottom:'.$margin_bottom.'px;}';
		}
        //call css on header
        wp_register_style( $component_id.'-css', false );
        wp_enqueue_style( $component_id.'-css' );
        wp_add_inline_style( $component_id.'-css', $custom_css );
        
        $html = '<div class="vc-customboxcontainer-wrap '.((!empty($el_class))?$el_class:'').'" id="'.$component_id.'">'.do_shortcode( $content ).'</div>';
        return $html;
    }
}
new customBox();
}