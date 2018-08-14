<?php
/*
Element Description: Advanced Button
*/
 
// Element Class 
class advButton extends WPBakeryShortCode {
    function __construct() {
        add_action( 'init', array( $this, 'adv_button_mapping' ) );
        add_shortcode( 'adv_button', array( $this, 'adv_button_html' ) );
    }
     
    // Element Mapping
    public function adv_button_mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
        vc_map( 
            array(
                'name' => __('Advanced Button', 'hipercriativo'),
                'base' => 'adv_button',
                //'description' => __('Advanced button', 'hipercriativo'), 
                /*'category' => __('My Custom Elements', 'hipercriativo'), */
                'icon' => 'icon-adv-button vc_mk_element-icon',          
                'params' => array(
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
                        'heading' => __( 'Button Target', 'hipercriativo' ),
                        'param_name' => 'btn_target',
                        'value' =>
                        array(
                            'Self'   => '_self',
                            'New tab' => '_blank',
                        ),
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
                                'Rounded' => 'btn-rounded',
                                'Circle'  => 'btn-circle',
                                'Outline'  => 'btn-outline',
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
                        'type' => 'numberfield',
                        'heading' => __( 'Custom width', 'hipercriativo' ),
                        'param_name' => 'btn_width',
                        'value' =>__( '', 'hipercriativo' ),
                        'description' => __( 'Box custom width (in px)', 'hipercriativo' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Styles'
                    ), 
                    array(
                        'type' => 'numberfield',
                        'heading' => __( 'Margin bottom', 'hipercriativo' ),
                        'param_name' => 'margin_bottom',
                        'value' =>__( '', 'hipercriativo' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Styles'
                    ),                     
                        
                ),
            )
        );       
    }
     
    public function adv_button_html( $atts ) {
        global $wpdb;
        extract(
            shortcode_atts(
                array(
                    'btn_text' => '',
                    'btn_text_color' => '#FFFFFF',
                    'btn_url' => '',
                    'btn_style' => 'btn-flat',
                    'btn_align' => 'text-center',
                    'btn_color' => '',
                    'btn_hover_color' => '',
                    'btn_width' => '',
                    'btn_target' => '_self',
                    'margin_bottom' => '',
                ), 
                $atts
            )
        );
        
        $component_id='vc-adv_button-'.uniqid();
        
        $custom_css='';
        if(!empty($btn_width)&&intval($btn_width)>0){
            $custom_css.='@media screen and (min-width:767px){#'.$component_id.' a{width:'.intval($btn_width).'px;}}';
        }
        if(!empty($btn_style))
        {
            if($btn_style=='btn-outline')
            {
                if(!empty($btn_text_color))$custom_css.='#'.$component_id.' a, #'.$component_id.' a span{color:'.$btn_text_color.';}';
                if(!empty($btn_color))
                {
                    $custom_css.='#'.$component_id.' a{background-color:transparent;border:1px solid '.$btn_color.';}';
                    //$custom_css.='#'.$component_id.' a:focus,#'.$component_id.' a:active{-webkit-box-shadow: 0px 0px 5px 0px '.$btn_color.';-moz-box-shadow: 0px 0px 5px 0px '.$btn_color.';box-shadow: 0px 0px 5px 0px '.$btn_color.';}';
                    $custom_css.='#'.$component_id.' a:focus,#'.$component_id.' a:active{-webkit-box-shadow: 0px 0px 0px 0px '.$btn_color.';-moz-box-shadow: 0px 0px 0px 0px '.$btn_color.';box-shadow: 0px 0px 0px 0px '.$btn_color.';}';
                }
                if(!empty($btn_hover_color)){
                    $custom_css.='#'.$component_id.' a:hover{background-color:transparent;color:'.$btn_hover_color.';border:1px solid '.$btn_hover_color.';}';
                }
            }
            else
            {
            if(!empty($btn_text_color))$custom_css.='#'.$component_id.' a, #'.$component_id.' a span{color:'.$btn_text_color.';}';
            if(!empty($btn_color)){
                $custom_css.='#'.$component_id.' a{background-color:'.$btn_color.';color:'.$btn_text_color.';}';
                //$custom_css.='#'.$component_id.' a:focus,#'.$component_id.' a:active{-webkit-box-shadow: 0px 0px 5px 0px '.$btn_color.';-moz-box-shadow: 0px 0px 5px 0px '.$btn_color.';box-shadow: 0px 0px 5px 0px '.$btn_color.';}';
                $custom_css.='#'.$component_id.' a:focus,#'.$component_id.' a:active{-webkit-box-shadow: 0px 0px 0px 0px '.$btn_color.';-moz-box-shadow: 0px 0px 0x 0px '.$btn_color.';box-shadow: 0px 0px 0px 0px '.$btn_color.';}';
            }
            if(!empty($btn_hover_color))$custom_css.='#'.$component_id.' a:hover{background-color:'.$btn_hover_color.';color:'.$btn_text_color.';}';
            }
        }
        
        //call css on header
        wp_register_style( $component_id.'-css', false );
        wp_enqueue_style( $component_id.'-css' );
        wp_add_inline_style( $component_id.'-css', $custom_css );
        
        $btn_target=($btn_target=='_blank'&&$btn_target&&$btn_url)?'target="_blank"':'target="_self"';
        
        $html = '
        <div class="vc-adv_button-wrap" id="'.$component_id.'">
            <div class="vc-adv_button-btn-holder '.(($btn_align)?$btn_align:'').'"><a href="'.(($btn_url&&!empty($btn_url))?$btn_url:'#').'" class="vc-adv_button-btn btn '.$btn_style.'" '.$btn_target.'>'.(($btn_text)?$btn_text:__('Read more','hipercriativo')).'</a></div>
        </div>';
        return $html;
    }
     
}
new advButton();