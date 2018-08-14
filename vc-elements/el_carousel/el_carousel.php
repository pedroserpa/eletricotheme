<?php
/*
Element Description: Content Carousel
*/
 
// Element Class 
class eletricoCarouselBox extends WPBakeryShortCode {
    function __construct() {
        add_action( 'init', array( $this, 'eletrico_carousel_mapping' ) );
        add_shortcode( 'eletrico_carousel', array( $this, 'eletrico_carousel_html' ) );
    }
     
    // Element Mapping
    public function eletrico_carousel_mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
        vc_map( 
            array(
                'name' => __('BS Carousel', 'hipercriativo'),
                'base' => 'eletrico_carousel',
                'icon' => 'icon-el-carousel vc_mk_element-icon',
                /*'category' => __('My Custom Elements', 'hipercriativo'), */  
                /*'icon' => get_template_directory_uri().'/assets/images/vc-icon.png', */           
                'params' => array(
                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'param_name' => 'smallslides',
                        // Note params is mapped inside param-group:
                        'params' => array(
                            array(
                                'type' => 'textfield',
                                'value' => '',
                                'heading' => 'Title',
                                'param_name' => 'title',
                            ),
                            array(
                                'type' => 'textarea',
                                /*'class' => 'text-class',*/
                                'heading' => __( 'Text', 'hipercriativo' ),
                                'param_name' => 'text',
                                'value' => __( '', 'hipercriativo' ),
                                'description' => __( 'Box Text', 'hipercriativo' ),
                                'admin_label' => false,
                                'weight' => 0,
                            ), 
                            array(
                                'type' => 'attach_image',
                                /*'class' => 'text-class',*/
                                'heading' => __( 'Image', 'hipercriativo' ),
                                'param_name' => 'image',
                                'value' => __( '', 'hipercriativo' ),
                                'description' => __( 'Enter content image', 'hipercriativo' ),
                                'admin_label' => false,
                                'weight' => 0,
                            ),
                            array(
                                'type' => 'textfield',
                                /*'class' => 'button-class',*/
                                'heading' => __( 'Button Text', 'hipercriativo' ),
                                'param_name' => 'btn_text',
                                'value' => __( '', 'hipercriativo' ),
                                'description' => __( 'Button Text', 'hipercriativo' ),
                                'admin_label' => false,
                                'weight' => 0,
                                'group' => 'Button',
                            ),
                            array(
                                'type' => 'textfield',
                                /*'class' => 'button-class',*/
                                'heading' => __( 'Button URL', 'hipercriativo' ),
                                'param_name' => 'btn_url',
                                'value' => __( '', 'hipercriativo' ),
                                'description' => __( 'Button URL', 'hipercriativo' ),
                                'admin_label' => false,
                                'weight' => 0,
                                'group' => 'Button',
                            ),
                            array(
                                'type' => 'dropdown',
                                /*'class' => 'button-class',*/
                                'heading' => __( 'Button Style', 'hipercriativo' ),
                                'param_name' => 'btn_style',
                                'value' =>
                                array(
                                        'Primary'   => 'btn--primary',
                                        'Flat'   => 'btn-flat',
                                        'Pointy'   => 'btn-pointy',
                                        'Rounded' => 'btn-rounded',
                                        'Circle'  => 'btn-circle'
                                ),
                                'description' => __( 'Button Appearance', 'hipercriativo' ),
                                'admin_label' => false,
                                'weight' => 0,
                                'group' => 'Button',
                            ),
                        )
                    )
                )
            )
        );       
    }
     
    public function eletrico_carousel_html( $atts ) {
        global $wpdb;
        extract(
            shortcode_atts(
                array(
                    'smallslides'   => '',
                    'show_nav' => 'true',
                    'show_controls' => 'true',
                    'image_size' => 'medium',
                ), 
                $atts
            )
        );
        
        $component_id='vc-slick_carousel-'.uniqid();
        
        $imgs='';
        if(!empty($smallslides)){
            $slides = vc_param_group_parse_atts( $atts['smallslides'] );
            
            foreach($slides as $slide):
            $img=wp_get_attachment_url($slide['image']);
            if($img)
            {
                $imgs.='<div><img src="'.$img.'" />';
                if(!empty($slide['title'])) $imgs.= '<h2><strong>'.$slide['title'].'</strong></h2>';
                if(!empty($slide['title'])) $imgs.= '<p>'.$slide['text'].'</p>';
                      if(!empty($slide['btn_url']) ):
                            $imgs.='<div class="text-center btn-wrapper">
                              <a href="'.(($slide['btn_url'])?$slide['btn_url']:'#').'" role="button" class="btn '.$slide['btn_style'].'">
                                <span>'.(($slide['btn_text'])?$slide['btn_text']:__('Read more','hipercriativo')).'</span>
                              </a>
                            </div>';
                      endif;
                $imgs.='</div>';
            }
            endforeach;
            
        }
        
        $html = '<div class="small-slick slick-margin--bottom" id="'.$component_id.'"><div class="row"><div class="col-md-12 heroSlider-fixed"><div class="slider slick-small">'.$imgs.'</div></div></div></div>';
        return $html;
     }
}
new eletricoCarouselBox();