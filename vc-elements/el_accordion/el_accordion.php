<?php
/*
Element Description: Eletrico Accordion
*/
 
// Element Class 
class elAccordion extends WPBakeryShortCode {
    function __construct() {
        add_action( 'init', array( $this, 'el_accordion_mapping' ) );
        add_shortcode( 'el_accordion', array( $this, 'el_accordion_html' ) );
    }
     
    // Element Mapping
    public function el_accordion_mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
        vc_map( 
            array(
                'name' => __('Elétrico Accordion', 'hipercriativo'),
                'base' => 'el_accordion',
                'icon' => 'icon-el-accordion vc_mk_element-icon',       
                'params' => array(
                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'param_name' => 'panels',
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
     
    public function el_accordion_html( $atts ) {
        global $wpdb;
        extract(
            shortcode_atts(
                array(
                    'panels'   => '',
                    'image_size' => 'large',
                    'image_width' => '',
                    'image_height' => ''
                ), 
                $atts
            )
        );
        
        $component_id='vc-el-accordion-'.uniqid();
        $custom_css='';$accordion='';
        $i=1;
        if(!empty($panels)){
            $panels = vc_param_group_parse_atts( $atts['panels'] );
            
            foreach($panels as $panel):
            if(!empty($panel['btn_style'])){
                if($panel['btn_style']=='btn-outline')
                {
                    $custom_css.='#'.$component_id.' #slick-item-'.$i.' .btn-outline{border:1px solid '.$panel['btn_color'].';color:'.$panel['btn_color'].';background-color:transparent;}';
                    $custom_css.='#'.$component_id.' #slick-item-'.$i.' .btn-outline:hover, #'.$component_id.' #slick-item-'.$i.' .btn-outline:focus{border:1px solid '.$panel['btn_hover_color'].';color:'.$panel['btn_hover_color'].';background-color:transparent;}';
                }
                else
                {
                    $custom_css.='#'.$component_id.' #slick-item-'.$i.' .btn{background-color:'.$panel['btn_color'].';}';
                    if(!empty($panel['btn_text_color']))$custom_css.='#'.$component_id.' #slick-item-'.$i.' .btn{color:'.$panel['btn_text_color'].';}';
                    if(!empty($panel['btn_hover_color']))$custom_css.='#'.$component_id.' #slick-item-'.$i.' .btn:hover{background-color:'.$panel['btn_color'].';}';
                    if(!empty($panel['btn_color']))$custom_css.='#'.$component_id.' #slick-item-'.$i.' .btn:hover{color:'.$panel['btn_color'].';}';
                }
            }
            
            if($image_size&&$image_size=='large'){
                $img=wp_get_attachment_image_src ( $panel['image'], '16_9_large' );
                if($img)$img=$img[0];
                else $img=wp_get_attachment_url($panel['image']);
            }
            if($image_size&&$image_size=='custom'&&!empty($image_width)&&!empty($image_height)){
                $img=wp_get_attachment_url ($panel['image']);
                if($img){
                $params = array( 'width' => intval($image_width), 'height' => intval($image_height), 'crop'=>true, 'quality'=>100 );
                $img=bfi_thumb( $img, $params );
                }else $img=wp_get_attachment_image_src ( $panel['image'], '16_9_large' );
            }
            else $img=wp_get_attachment_url($panel['image']);
            
            
           
                $accordion.='
                <div class="accordion-item '.( ($i==0)?'accordion-active':'' ).'" id="accordion-item-'.$i.'">
                      <div class="accordion-item-title"
                          '.( ($img) ? 'style="background:url('.urldecode($img).')"' : '').'
                          >
                          <h3><span class="icon"><i class="fa fa-plus"></i><i class="fa fa-minus"></i></span> '.(($panel['title'])?$panel['title']:'').'</h3>
                      </div>
                      <div class="accordion-item-content">
                            <p>'.(($panel['text'])?$panel['text']:'').'</p>';

                              if($panel['title']!=''&&$panel['btn_url']!=''&&$panel['btn_url']!='#'&&!empty($panel['btn_url'])):
                              $accordion.='<div class="btn-wrapper"><a href="'.(($panel['btn_url'])?$panel['btn_url']:'#').'" role="button" class="btn '.$panel['btn_style'].'">
                                '.(($panel['btn_text'])?$panel['btn_text']:__('Read more','hipercriativo')).'
                              </a></div>';
                              endif;
                      $accordion.='</div>
                </div>';
            
            $i++;
            endforeach;
        }
        if($custom_css!=''):
            wp_register_style( $component_id.'-css', false );
            wp_enqueue_style( $component_id.'-css' );
            wp_add_inline_style( $component_id.'-css', $custom_css );
        endif;
        $html = '<div class="el-accordion" id="'.$component_id.'">';
        $html .= $accordion;
        $html .= '</div>';
        return $html;
    }
     
}
new elAccordion();