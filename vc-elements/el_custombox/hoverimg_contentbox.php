<?php
/*
Element Description: Hover Img Content Box
*/
 
// Element Class 
class hoverImgContentBox extends WPBakeryShortCode {
    function __construct() {
        add_action( 'init', array( $this, 'hoverimg_contentbox_mapping' ) );
        add_shortcode( 'hoverimg_contentbox', array( $this, 'hoverimg_contentbox_html' ) );
    }
     
    // Element Mapping
    public function hoverimg_contentbox_mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
        vc_map( 
            array(
                'name' => __('VW Content Box', 'hipercriativo'),
                'base' => 'hoverimg_contentbox',
                'description' => __('Advanced Content Box', 'hipercriativo'), 
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
                        /*'class' => 'text-class',*/
                        'heading' => __( 'Text', 'hipercriativo' ),
                        'param_name' => 'text',
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
                        'heading' => __( 'Background Image', 'hipercriativo' ),
                        'param_name' => 'image',
                        'value' => __( '', 'hipercriativo' ),
                        'description' => __( 'Box background Image', 'hipercriativo' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Styles',
                    ),
                    array(
                        'type' => 'dropdown',
                        /*'class' => 'button-class',*/
                        'heading' => __( 'Background Type', 'hipercriativo' ),
                        'param_name' => 'image_size',
                        'value' =>
                        array(
                                '100%' => '100%',
                                'Contain' => 'contain',
                                'Cover'   => 'cover',
                        ),
                        'description' => __( 'Background adjustment size', 'hipercriativo' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Styles',
                        'dependency' => 'image',
                    ),
                    array(
                        'type' => 'numberfield',
                        'heading' => __( 'Box height', 'hipercriativo' ),
                        'param_name' => 'box_height',
                        'value' =>__( '100', 'hipercriativo' ),
                        'description' => __( 'Box custom height (in px)', 'hipercriativo' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Styles'
                    ),                     
                        
                ),
            )
        );       
    }
     
    public function hoverimg_contentbox_html( $atts ) {
        global $wpdb;
        extract(
            shortcode_atts(
                array(
                    'title'   => '',
                    'text' => '',
                    'image' => '',
                    'image_size' => '100%',
                    'btn_text' => '',
                    'btn_text_color' => '#FFFFFF',
                    'btn_url' => '',
                    'btn_style' => '',
                    'btn_align' => 'text-center',
                    'btn_color' => '',
                    'btn_hover_color' => '',
                    'box_height' => '100',
                ), 
                $atts
            )
        );
        
        $component_id='vc-hoverimg_contentbox-'.uniqid();
        
        $custom_css='';
        if(!empty($box_height)){
            $custom_css.='#'.$component_id.'{min-height:'.intval($box_height).'px;}';
        }
        $bg='';
        if(!empty($image)){
            $img=wp_get_attachment_url($image);
            if($img)
            {
                $bg='#'.$component_id.'{background:url('.$img.') center center no-repeat;}';
                $custom_css.=$bg;
                if(!empty($image_size))$custom_css.='#'.$component_id.'{background-size:'.$image_size.';}';
            }
        }
        
        $btn_id='vc-hoverimg_contentbox-btn-'.uniqid();
        if(!empty($btn_text_color))$custom_css.='#'.$btn_id.' a, #'.$btn_id.' span{color:'.$btn_text_color.';}';
        if(!empty($btn_color))$custom_css.='#'.$btn_id.'{background-color:'.$btn_color.';}';
        if(!empty($btn_hover_color))$custom_css.='#'.$btn_id.':hover{background-color:'.$btn_hover_color.';}';
        
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
        
        if(!empty($title))$title='<h2 class="vc-hoverimg_contentbox-title">' . $title . '</h2>';
        if(!empty($text))$text='<h2 class="vc-hoverimg_contentbox-text">' . $text . '</h2>';
        
        $html = '
        <div class="vc-hoverimg_contentbox-wrap" id="'.$component_id.'">
            ' . $title . '
            ' . $text . '
            <div class="vc-hoverimg_contentbox-btn-holder '.$btn_align.'"><div id="'.$btn_id.'" class="vc-hoverimg_contentbox-btn btn '.$btn_class.'">'.$btn_link.'</div></div>
        </div>';
        return $html;
    }
     
}
new hoverImgContentBox();