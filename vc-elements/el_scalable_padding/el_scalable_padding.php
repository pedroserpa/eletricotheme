<?php
/*
Element Description: Scalable Padding Space
*/
 
// Element Class 
class scalablePaddingSpace extends WPBakeryShortCode {
    function __construct() {
        add_action( 'init', array( $this, 'el_scalable_padding_mapping' ) );
        add_shortcode( 'el_scalable_padding', array( $this, 'el_scalable_padding_html' ) );
    }
     
    // Element Mapping
    public function el_scalable_padding_mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
        vc_map( 
            array(
                'name' => __('Scalable Padding Space', 'hipercriativo'),
                'base' => 'el_scalable_padding',
                'icon' => 'icon-el-padding vc_mk_element-icon',
                'description' => __('Spacer with dynamic padding', 'hipercriativo'), 
                /*'category' => __('My Custom Elements', 'hipercriativo'), */  
                /*'icon' => get_template_directory_uri().'/assets/images/vc-icon.png', */           
                "params" => array(
                    array(
                        "type" => "numberfield",
                        "heading" => __("Padding Size (%)", "hipercriativo"),
                        "param_name" => "padding_size",
                        "value" => "40",
                        "min" => "1",
                        /*"max" => "500",
                        "step" => "1",
                        "unit" => '%',*/
                        "description" => __("How much padding/height would you like to add (in %)?", "hipercriativo")
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
                            __('Hidden on Extra Small Devices','hipercriativo') => 'hidden-xs',
                            __('Hidden on Small Devices','hipercriativo') => 'hidden-sm',
                            __('Hidden on Medium Devices','hipercriativo') => 'hidden-md',
                            __('Hidden on Large Devices','hipercriativo') => 'hidden-lg',
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
     
    public function el_scalable_padding_html( $atts ) {
        //global $wpdb;
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
        
        $component_id='el_scalable_padding-'.uniqid();
        
        $custom_css='';
        if(!empty($padding_size)){
            $custom_css='#'.$component_id.'{min-height:'.$padding_size.'vh;height:'.$padding_size.'%;}';
            wp_register_style( $component_id.'-css', false );
            wp_enqueue_style( $component_id.'-css' );
            wp_add_inline_style( $component_id.'-css', $custom_css );
        }
        
        $html = '<div id="'.$component_id.'" class="el-padding';
        $html.=((!empty($visibility))?' '.$visibility:'').' clearfix';
        $html.='"></div>';
        return $html;
    }

}
new scalablePaddingSpace();