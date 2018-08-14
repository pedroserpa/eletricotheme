<?php
/*
Element Description: VW Image
*/
 
// Element Class 
class vwImage extends WPBakeryShortCode {
    function __construct() {
        add_action( 'init', array( $this, 'el_vw_image_mapping' ) );
        add_shortcode( 'el_vw_image', array( $this, 'el_vw_image_html' ) );
    }
     
    // Element Mapping
    public function el_vw_image_mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
        vc_map( 
            array(
                'name' => __('VW Image', 'hipercriativo'),
                'base' => 'el_vw_image',
                'icon' => 'icon-el-vw-image vc_mk_element-icon',
                'description' => __('Simple single image holder', 'hipercriativo'), 
                /*'category' => __('My Custom Elements', 'hipercriativo'), */  
                /*'icon' => get_template_directory_uri().'/assets/images/vc-icon.png', */           
                "params" => array(
                    array(
                        'type' => 'attach_image',
                        /*'class' => 'text-class',*/
                        'heading' => __( 'Image', 'hipercriativo' ),
                        'param_name' => 'image',
                        'value' => __( '', 'hipercriativo' ),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Width (Px)", "hipercriativo"),
                        "param_name" => "width",
                        "value" => ""
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Height (Px)", "hipercriativo"),
                        "param_name" => "height",
                        "value" => "",
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
     
    public function el_vw_image_html( $atts ) {
        global $wpdb;
        extract(
            shortcode_atts(
                array(
                    'image' 	=> '',
                    'width' 	=> '',
                    'height' 	=> '',
                    'visibility'=>'',
                    'responsive_rules'=>0
                ), 
                $atts
            )
        );
        
        if(empty($image))return ;
        else {
            if(!empty($width)&&!empty($height))
            {
                $image=wp_get_attachment_url($image);
                $params = array( 'width' => intval($width), 'height' => intval($height), 'crop'=>true, 'quality'=>100 );
                $image=bfi_thumb( $image, $params );
            }
            else $image=wp_get_attachment_url($image);
        }
        
        $component_id='el_vw_image-'.uniqid();
        
        $custom_css='';
        /*if(!empty($padding_size)){
            $custom_css='#'.$component_id.'{height:'.$padding_size.'px;}';
            wp_register_style( $component_id.'-css', false );
            wp_enqueue_style( $component_id.'-css' );
            wp_add_inline_style( $component_id.'-css', $custom_css );
        }*/
        
        $html = '<div id="'.$component_id.'" class="el-image';
        $html.=((!empty($visibility))?' '.$visibility:'').' clearfix';
        $html.='"><img src="'.$image.'" class="img-fluid"></div>';
        return $html;
    }

}
new vwImage();