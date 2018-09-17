<?php
/*
Element Description: Media Content Box
*/
 
// Element Class 
class mediaContentBox extends WPBakeryShortCode {
    function __construct() {
        add_action( 'init', array( $this, 'media_contentbox_mapping' ) );
        add_shortcode( 'media_contentbox', array( $this, 'media_contentbox_html' ) );
    }
     
    // Element Mapping
    public function media_contentbox_mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
        vc_map( 
            array(
                'name' => __('Elétrico Media Box', 'hipercriativo'),
                'base' => 'media_contentbox',
                'icon' => 'icon-media_contentbox vc_mk_element-icon',
                /*'category' => __('My Custom Elements', 'hipercriativo'), */  
                /*'icon' => get_template_directory_uri().'/assets/images/vc-icon.png', */           
                'params' => array(   
                    array(
                        'type' => 'textfield',
                        /*'class' => 'title-class',*/
                        'heading' => __( 'Title', 'hipercriativo' ),
                        'param_name' => 'title',
                        'value' => __( '', 'hipercriativo' ),
                        'description' => __( 'Box Title', 'hipercriativo' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Content',
                    ),  
                     
                    array(
                        'type' => 'textarea_html',
                        'holder' => 'div',
                        'heading' => __( 'Text', 'hipercriativo' ),
                        'param_name' => 'content',
                        'value' => __( '', 'hipercriativo' ),
                        'description' => __( 'Box Text', 'hipercriativo' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Content',
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
                                'Flat'   => 'btn-flat',
                                'Pointy'   => 'btn-pointy',
                                'Rounded' => 'btn-rounded',
                                'Circle'  => 'btn-circle',
                        ),
                        'description' => __( 'Button Appearance', 'hipercriativo' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Button',
                    ),
                    array(
                        'type' => 'dropdown',
                        /*'class' => 'button-class',*/
                        'heading' => __( 'Button Alignment', 'hipercriativo' ),
                        'param_name' => 'btn_align',
                        'value' =>
                        array(
                                'Center' => 'text-center',
                                'Left'   => 'text-left',
                                'Right'   => 'text-right',
                        ),
                        'description' => __( 'Button Alignment', 'hipercriativo' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Button',
                    ),
                    array(
                        'type' => 'colorpicker',
                        /*'class' => 'button-class',*/
                        'heading' => __( 'Button Text Color', 'hipercriativo' ),
                        'param_name' => 'btn_text_color',
                        'value' =>__( '#FFFFFF', 'hipercriativo' ),
                        'description' => __( 'Button text color', 'hipercriativo' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Button',
                    ), 
                    array(
                        'type' => 'colorpicker',
                        /*'class' => 'button-class',*/
                        'heading' => __( 'Button Color', 'hipercriativo' ),
                        'param_name' => 'btn_color',
                        'value' =>__( '', 'hipercriativo' ),
                        'description' => __( 'Button normal color', 'hipercriativo' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Button',
                    ), 
                    array(
                        'type' => 'colorpicker',
                        /*'class' => 'button-class',*/
                        'heading' => __( 'Button Hover Color', 'hipercriativo' ),
                        'param_name' => 'btn_hover_color',
                        'value' =>__( '', 'hipercriativo' ),
                        'description' => __( 'Button on mouseover color', 'hipercriativo' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Button',
                        'dependency' => 'btn_color'
                    ),
                    array(
                        'type' => 'attach_image',
                        /*'class' => 'text-class',*/
                        'heading' => __( 'Image', 'hipercriativo' ),
                        'param_name' => 'image',
                        'value' => __( '', 'hipercriativo' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Content',
                    ),                 
                        
                ),
            )
        );       
    }
     
    public function media_contentbox_html( $atts,$content ) {
        global $wpdb;
        extract(
            shortcode_atts(
                array(
                    'title'   => '',
                    'image' => '',
                    'btn_text' => '',
                    'btn_text_color' => '#FFFFFF',
                    'btn_url' => '',
                    'btn_style' => '',
                    'btn_align' => 'text-center',
                    'btn_color' => '',
                    'btn_hover_color' => '',
                ), 
                $atts
            )
        );
        
        $component_id='vc-media_contentbox_contentbox-'.uniqid();
        $custom_css='';
        $btn_id='vc-media_contentbox-btn-'.uniqid();
        if(!empty($btn_text_color))$custom_css.='#'.$btn_id.' a, #'.$btn_id.' span{color:'.$btn_text_color.';}';
        if(!empty($btn_color))$custom_css.='#'.$btn_id.' a{background-color:'.$btn_color.';}';
        if(!empty($btn_hover_color))$custom_css.='#'.$btn_id.' a:hover{background-color:'.$btn_hover_color.';}';
        
        //element markup
        $btn_class="";
        if(!empty($btn_style)){
            $btn_class.=$btn_style;
            $custom_css.= '#'.$btn_id.'.btn-pointy:after {
                content:"";
                position:absolute;
                top:-6px;
                left:44%;
                width:0;
                height:0;
                border-left: 5px solid transparent;
                border-right: 5px solid transparent;
                border-bottom: 5px solid '.$btn_color.';
            }';
            if(!empty($btn_hover_color)){
                $custom_css.='#'.$btn_id.'.btn-pointy:hover:after{ border-bottom: 5px solid '.$btn_hover_color.';}';
            }
        }
        if(!empty($btn_align))$btn_align=$btn_align;
        $btn_link='<a href="#"><span>' . $btn_text . '</span></a>';
        if(!empty($btn_url))$btn_link='<a href="'.$btn_url.'"><span>' . $btn_text . '</span></a>';
        
        //call css on header
        wp_register_style( $component_id.'-css', false );
        wp_enqueue_style( $component_id.'-css' );
        wp_add_inline_style( $component_id.'-css', $custom_css );
        
        if(!empty($title))$title='<h2 class="media_contentbox_contentbox-title">' . $title . '</h2>';
        if(!empty($content))$content='<h2 class="media_contentbox_contentbox-text">' . wpb_js_remove_wpautop($content,true) . '</h2>';
        
        $html = '
        <div class="vc-media_contentbox-wrap media-cta" id="'.$component_id.'">
            <div class="media-cta__img">';
                if(!empty($image)){
                $img=wp_get_attachment_url($image);
                if($img) $html .= '<img src="'.$img.'" class="img-fluid">';
                }
              $html .= '</div>';
              
                $html .= $title . wpb_js_remove_wpautop($content) ;
            $html .= '<div class="media_contentbox_contentbox-btn-holder '.$btn_align.'"><div id="'.$btn_id.'" class="media_contentbox-btn btn '.$btn_class.'">'.$btn_link.'</div></div>
        </div>';
        return $html;
    }
     
}
new mediaContentBox();