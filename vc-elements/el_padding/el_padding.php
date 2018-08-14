<?php
/*
Element Description: Padding Space
*/
 
// Element Class 
class paddingSpace extends WPBakeryShortCode {
    function __construct() {
        add_action( 'init', array( $this, 'el_padding_mapping' ) );
        add_shortcode( 'el_padding', array( $this, 'el_padding_html' ) );
    }
     
    // Element Mapping
    public function el_padding_mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
        vc_map( 
            array(
                'name' => __('Padding Space', 'hipercriativo'),
                'base' => 'el_padding',
                'icon' => 'icon-el-padding vc_mk_element-icon',
                'description' => __('Spacer with padding element', 'hipercriativo'), 
                /*'category' => __('My Custom Elements', 'hipercriativo'), */  
                /*'icon' => get_template_directory_uri().'/assets/images/vc-icon.png', */           
                "params" => array(
                    array(
                        "type" => "numberfield",
                        "heading" => __("Padding Size (Px)", "hipercriativo"),
                        "param_name" => "padding_size",
                        "value" => "40",
                        "min" => "1",
                        /*"max" => "500",
                        "step" => "1",
                        "unit" => 'px',*/
                        "description" => __("How much padding/height would you like to add?", "hipercriativo")
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Visibility Rules", "hipercriativo"),
                        "param_name" => "responsive_rules",
                        "value" => array(
                            __("No rules","hipercriativo") => "0",
                            __("Yes please","hipercriativo") => "1"
                        )
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Visibility", "hipercriativo"),
                        "description" => __("", "hipercriativo"),
                        "param_name" => "visibility",
                        "value" => array(
                            __('Visible to All','hipercriativo') => '',
                            __('Visible on Extra Small Devices','hipercriativo') => 'vc_visible-xs',
                            __('Visible on Small Devices','hipercriativo') => 'vc_visible-sm',
                            __('Visible on Medium Devices','hipercriativo') => 'vc_visible-md',
                            __('Visible on Large Devices','hipercriativo') => 'vc_visible-lg',
                            __('Hidden on Extra Small Devices','hipercriativo') => 'vc_hidden-xs',
                            __('Hidden on Small Devices','hipercriativo') => 'vc_hidden-sm',
                            __('Hidden on Medium Devices','hipercriativo') => 'vc_hidden-md',
                            __('Hidden on Large Devices','hipercriativo') => 'vc_hidden-lg',
                        ),
                        "dependency" => array(
                            "element" => "responsive_rules",
                            "value" => array("1")
                        )
                    )
                )
            )
        );       
    }
     
    public function el_padding_html( $atts ) {
        extract(
            shortcode_atts(
                array(
                    'padding_size' 	=> '40',
                    'visibility'=>'',
                    'responsive_rules'=>0
                ), 
                $atts
            )
        );
        
        $component_id='el_padding-'.uniqid();
        
        $custom_css='';
        if(!empty($padding_size)){
            $custom_css='#'.$component_id.'{height:'.$padding_size.'px;}';
            wp_register_style( 'electrico-style-css', false );
            wp_enqueue_style( 'electrico-style-css' );
            wp_add_inline_style( 'electrico-style-css', $custom_css );
        }
        $html = '<div id="'.$component_id.'" class="el-padding';
        $html.=((!empty($visibility))?' '.$visibility:'').' clearfix';
        $html.='"></div>';
        return $html;
    }
}
new paddingSpace();