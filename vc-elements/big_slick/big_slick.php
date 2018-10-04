<?php
/*
Element Description: Big Slick Slider
*/
 
// Element Class 
class bigSlick extends WPBakeryShortCode {
    function __construct() {
        add_action( 'init', array( $this, 'big_slick_mapping' ) );
        add_shortcode( 'big_slick', array( $this, 'big_slick_html' ) );
    }
     
    // Element Mapping
    public function big_slick_mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
        vc_map( 
            array(
                'name' => __('Big Slick Slider', 'hipercriativo'),
                'base' => 'big_slick',
                'icon' => 'icon-big-slick vc_mk_element-icon', 
                /*'category' => __('My Custom Elements', 'hipercriativo'), */  
                /*'icon' => get_template_directory_uri().'/assets/images/vc-icon.png', */           
                'params' => array(
                    array(
                        'type' => 'dropdown',
                        /*'class' => 'button-class',*/
                        'heading' => __( 'Image Size', 'hipercriativo' ),
                        'param_name' => 'image_size',
                        'value' =>
                        array(
                            'Original'   => 'original',
                            'Large'   => 'large',
                            'Custom'   => 'custom'
                        ),
                        'admin_label' => false,
                        'weight' => 0,
                    ),
                    array(
                        'type' => 'numberfield',
                        'heading' => __( 'Custom width', 'hipercriativo' ),
                        'param_name' => 'image_width',
                        'value' =>__( '', 'hipercriativo' ),
                        'description' => __( 'Image custom width (in px)', 'hipercriativo' ),
                        'dependency' => array('element'=>'image_size', 'value'=>array('custom'))
                    ),
                    array(
                        'type' => 'numberfield',
                        'heading' => __( 'Custom height', 'hipercriativo' ),
                        'param_name' => 'image_height',
                        'value' =>__( '', 'hipercriativo' ),
                        'description' => __( 'Image custom height (in px)', 'hipercriativo' ),
                        'dependency' => array('element'=>'image_size', 'value'=>array('custom'))
                    ),
                    array(
                        'type' => 'checkbox',
                        /*'class' => 'button-class',*/
                        'heading' => __( 'Full Height?', 'hipercriativo' ),
                        'param_name' => 'full_height',
                        'value' =>'',
                        'admin_label' => false,
                        'weight' => 0,
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Add arrow down?', 'hipercriativo' ),
                        'param_name' => 'arrow_down',
                        'value' =>
                        array(
                            'Yes'   => 'true',
                            'No' => 'false'
                        ),
                        'admin_label' => false
                    ),
                    array(
                        'type' => 'textfield',
                        /*'class' => 'button-class',*/
                        'heading' => __( 'Arrow target link', 'hipercriativo' ),
                        'param_name' => 'arrow_down_url',
                        'value' => __( '', 'hipercriativo' ),
                        'admin_label' => false,
                        'dependency' => array(
                            'element' => 'arrow_down',
                            'value' => 'true'
                        )
                    ),
                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'param_name' => 'bigslides',
                        // Note params is mapped inside param-group:
                        'params' => array(
                            array(
                                'type' => 'textfield',
                                'value' => '',
                                'heading' => 'Title',
                                'param_name' => 'title',
                            ),array(
                                'type' => 'textarea',
                                'value' => '',
                                'heading' => 'Text',
                                'param_name' => 'text',
                            ),
                            array(
                                'type' => 'attach_image',
                                /*'class' => 'text-class',*/
                                'heading' => __( 'Image', 'hipercriativo' ),
                                'param_name' => 'image',
                                'value' => __( '', 'hipercriativo' ),
                                'description' => __( 'Enter custom image caption', 'hipercriativo' ),
                                'admin_label' => false,
                                'weight' => 0,
                            ),
                            array(
                                'type' => 'textfield',
                                /*'class' => 'button-class',*/
                                'heading' => __( 'Button Text', 'hipercriativo' ),
                                'param_name' => 'btn_text',
                                'value' => __( '', 'hipercriativo' ),
                                'admin_label' => false,
                                'weight' => 0,
                                'group' => 'Button',
                            ),
                            array(
                                'type' => 'textfield',
                                /*'class' => 'button-class',*/
                                'heading' => __( 'Button URL', 'hipercriativo' ),
                                'param_name' => 'btn_url',
                                'value' => __( '#', 'hipercriativo' ),
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
                                        'Flat'   => 'btn-flat',
                                        'Pointy'   => 'btn-pointy',
                                        'Rounded' => 'btn-rounded',
                                        'Circle'  => 'btn-circle',
                                        'Outline'  => 'btn-outline'
                                ),
                                'description' => __( 'Button Appearance', 'hipercriativo' ),
                                'admin_label' => false,
                                'weight' => 0,
                                'group' => 'Button',
                            ),
                            array(
                                'type' => 'colorpicker',
                                /*'class' => 'button-class',*/
                                'heading' => __( 'Button Color', 'hipercriativo' ),
                                'param_name' => 'btn_color',
                                'value' =>'',
                                'description' => __( 'Button background color', 'hipercriativo' ),
                                'admin_label' => false,
                                'weight' => 0,
                                'group' => 'Button',
                            ),
                            array(
                                'type' => 'colorpicker',
                                /*'class' => 'button-class',*/
                                'heading' => __( 'Button Text Color', 'hipercriativo' ),
                                'param_name' => 'btn_text_color',
                                'value' =>'',
                                'description' => __( 'Button text color', 'hipercriativo' ),
                                'admin_label' => false,
                                'weight' => 0,
                                'group' => 'Button',
                            ),
                            array(
                                'type' => 'colorpicker',
                                /*'class' => 'button-class',*/
                                'heading' => __( 'Button Hover Color', 'hipercriativo' ),
                                'param_name' => 'btn_hover_color',
                                'value' =>'',
                                'description' => __( 'Button hover color', 'hipercriativo' ),
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
     
    public function big_slick_html( $atts ) {
        global $wpdb;
        extract(
            shortcode_atts(
                array(
                    'bigslides'   => '',
                    'show_nav' => 'true',
                    'show_controls' => 'true',
                    'image_size' => 'large',
                    'image_width' => '',
                    'image_height' => '',
                    'full_height' => '',
                    'arrow_down' => 'true',
                    'arrow_down_url' => ''
                ), 
                $atts
            )
        );
        
        $component_id='vc-big_slick-'.uniqid();
        $custom_css=$imgs='';
        $i=1;
        if(!empty($bigslides)){
            $slides = vc_param_group_parse_atts( $atts['bigslides'] );
            
            foreach($slides as $slide):
            if(!empty($slide['btn_style'])){
                if($slide['btn_style']=='btn-outline')
                {
                    $custom_css.='#'.$component_id.' #slick-item-'.$i.' .btn-outline{border:1px solid '.$slide['btn_color'].';color:'.$slide['btn_color'].';background-color:transparent;}';
                    $custom_css.='#'.$component_id.' #slick-item-'.$i.' .btn-outline:hover, #'.$component_id.' #slick-item-'.$i.' .btn-outline:focus{border:1px solid '.$slide['btn_hover_color'].';color:'.$slide['btn_hover_color'].';background-color:transparent;}';
                }
                else
                {
                    $custom_css.='#'.$component_id.' #slick-item-'.$i.' .btn{background-color:'.$slide['btn_color'].';}';
                    if(!empty($slide['btn_text_color']))$custom_css.='#'.$component_id.' #slick-item-'.$i.' .btn{color:'.$slide['btn_text_color'].';}';
                    if(!empty($slide['btn_hover_color']))$custom_css.='#'.$component_id.' #slick-item-'.$i.' .btn:hover{background-color:'.$slide['btn_color'].';}';
                    if(!empty($slide['btn_color']))$custom_css.='#'.$component_id.' #slick-item-'.$i.' .btn:hover{color:'.$slide['btn_color'].';}';
                }
            }
            
            if($image_size&&$image_size=='large'){
                $img=wp_get_attachment_image_src ( $slide['image'], '16_9_large' );
                if($img)$img=$img[0];
                else $img=wp_get_attachment_url($slide['image']);
            }
            if($image_size&&$image_size=='custom'&&!empty($image_width)&&!empty($image_height)){
                $img=wp_get_attachment_url ($slide['image']);
                if($img){
                $params = array( 'width' => intval($image_width), 'height' => intval($image_height), 'crop'=>true, 'quality'=>100 );
                $img=bfi_thumb( $img, $params );
                }else $img=wp_get_attachment_image_src ( $slide['image'], '16_9_large' );
            }
            else $img=wp_get_attachment_url($slide['image']);
            
            if($img)
            {
                $copy='';
                if(!empty($slide['title']))
                {
                    $copy='<div class="container-fluid">
                          <div class="row">
                            <div class="col col-xs-12 text-center btn-wrapper">
                              <h1>'.(($slide['title'])?$slide['title']:'').'</h1>
                              <p>'.(($slide['text'])?$slide['text']:'').'</p>';
                              if($slide['title']!=''&&$slide['btn_url']&&!empty($slide['btn_url'])):
                              $imgs.='<a href="'.(($slide['btn_url'])?$slide['btn_url']:'#').'" role="button" class="btn '.$slide['btn_style'].'">
                                '.(($slide['btn_text'])?$slide['btn_text']:__('Read more','hipercriativo')).'
                              </a>';
                              endif;
                    $copy.='</div></div></div>';
                }

                $imgs.='
                <div class="item" id="slick-item-'.$i.'">
                    <div class="imageContainer">
                      <img src="'.urldecode($img).'" />
                      <div class="copy-container">'.$copy.'
                          
            
                      </div>
                    </div>
                  </div>';
            }
            $i++;
            endforeach;
        }
        if($custom_css!=''):
            wp_register_style( $component_id.'-css', false );
            wp_enqueue_style( $component_id.'-css' );
            wp_add_inline_style( $component_id.'-css', $custom_css );
        endif;
        $html = '<div class="slick-slider '.(($full_height==='true')?'full-height':'').'" id="'.$component_id.'"><div class="carousel">';
        $html .= $imgs;
        $html .= '</div>';
        if($arrow_down&&$arrow_down=='true'){
            $html .= '<a href="'.(($arrow_down_url)?$arrow_down_url:'#').'" role="button" class="btn arrow-down smooth-scroll">
            <i class="fa fa-angle-down"></i>
          </a>';
          }
        $html .= '</div>';
        return $html;
    }
     
}
new bigSlick();