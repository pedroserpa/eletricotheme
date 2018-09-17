<?php
/*
Element Description: Hover Img Content Box
*/
 
// Element Class 
class contentBox extends WPBakeryShortCode {
    function __construct() {
        add_action( 'init', array( $this, 'contentbox_mapping' ) );
        add_shortcode( 'el_contentbox', array( $this, 'contentbox_html' ) );
    }
     
    // Element Mapping
    public function contentbox_mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
        vc_map( 
            array(
                'name' => __('Content Box', 'hipercriativo'),
                'base' => 'el_contentbox',
                'description' => __('Advanced Content Box', 'hipercriativo'), 
                /*'category' => __('My Custom Elements', 'hipercriativo'), */  
                /*'icon' => get_template_directory_uri().'/assets/images/vc-icon.png', */   
'icon' => 'icon-el_customboxcontainer vc_mk_element-icon',				
                'params' => array(
                    array(
                        'type' => 'textarea_html',
                        /*'class' => 'text-class',*/
                        'heading' => __( 'Text', 'hipercriativo' ),
                        'param_name' => 'content',
                        'value' => __( '', 'hipercriativo' ),
						"holder" => "div",
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Content',
                    ),
					array(
                        'type' => 'numberfield',
                        'heading' => __( 'Text size', 'hipercriativo' ),
                        'param_name' => 'text_size',
                        'value' =>__( '18', 'hipercriativo' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Content'
                    ),
					array(
                        'type' => 'numberfield',
                        'heading' => __( 'Line Height', 'hipercriativo' ),
                        'param_name' => 'line_height',
                        'value' =>__( '22', 'hipercriativo' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Content'
                    ),

                    array(
                        'type' => 'checkbox',
                        'heading' => __( 'Use theme default font family?', 'hipercriativo' ),
                        'param_name' => 'use_theme_fonts',
                        'value' =>__( 'true', 'hipercriativo' ),
                        'admin_label' => false,
                        'group' => 'Content'
                    ),
					
					array(
						'type' => 'google_fonts',
						'param_name' => 'google_fonts',
						'value' => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
						'settings' => array(
							'fields' => array(
								'font_family_description' => __( 'Select font family.', 'js_composer' ),
								'font_style_description' => __( 'Select font styling.', 'js_composer' ),
							),
						),'group' => 'Content',
                        "dependency" => array(
                            "element" => "use_theme_fonts",
                            "value" => array("false")
                        )
					),
					array(
                        'type' => 'colorpicker',
                        /*'class' => 'text-class',*/
                        'heading' => __( 'Text Color', 'hipercriativo' ),
                        'param_name' => 'text_color',
                        'value' => __( '', 'hipercriativo' ),
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
                        'type' => 'colorpicker',
                        /*'class' => 'text-class',*/
                        'heading' => __( 'Background Color', 'hipercriativo' ),
                        'param_name' => 'bg_color',
                        'value' => __( '', 'hipercriativo' ),
                        'description' => __( 'Box background color', 'hipercriativo' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Styles',
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
					array(
                        'type' => 'numberfield',
                        'heading' => __( 'Vertical padding', 'hipercriativo' ),
                        'param_name' => 'padding_vertical',
                        'value' =>__( '10', 'hipercriativo' ),
                        'description' => __( 'Top and bottom padding (in px)', 'hipercriativo' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Styles'
                    ),
					array(
                        'type' => 'numberfield',
                        'heading' => __( 'Horizontal padding', 'hipercriativo' ),
                        'param_name' => 'padding_horizontal',
                        'value' =>__( '10', 'hipercriativo' ),
                        'description' => __( 'Left and right padding (in px)', 'hipercriativo' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Styles'
                    ),					
                        
                ),
            )
        );       
    }
     
    public function contentbox_html( $atts,$content=null ) {
        global $wpdb;
        extract(
            shortcode_atts(
                array(
					'bg_color'=>'',
					'text_color'=>'','text_size'=>'18','line_height'=>'22',
                    'use_theme_fonts'=>'true',
					'google_fonts'=>'',
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
					'padding_vertical'=>'10',
					'padding_horizontal'=>'10',
                ), 
                $atts
            )
        );
        
        $component_id='vc-contentbox-'.uniqid();
        
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
		if(!empty($bg_color)){
            $bg='#'.$component_id.'{background-color:'.$bg_color.';}';
            $custom_css.=$bg;
        }
		if(!empty($text_color)){
			$custom_css.='#'.$component_id.' .vc-contentbox-text{color:'.$text_color.';}';
		}
		if(!empty($text_size)){
			$custom_css.='#'.$component_id.' .vc-contentbox-text{font-size:'.$text_size.'px;}';
		}
		if(!empty($line_height)){
			$custom_css.='#'.$component_id.' .vc-contentbox-text{line-height:'.$line_height.'px;}';
		}
		if(!empty($padding_vertical)){
            $custom_css.='#'.$component_id.'{padding-top:'.$padding_vertical.'px;padding-bottom:'.$padding_vertical.'px;}';
        }
		if(!empty($padding_horizontal)){
            $custom_css.='#'.$component_id.'{padding-left:'.$padding_horizontal.'px;padding-right:'.$padding_horizontal.'px;}';
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
		
		if($content&&!empty($google_fonts)&&$use_theme_fonts!='true'):
			$google_fonts=new Eletrico_vc_custom_google_fonts($atts);
			if($google_fonts->style&&is_array($google_fonts->style)):
				$custom_css.='#'.$component_id.' .vc-contentbox-text {';
				foreach($google_fonts->style as $rule):
					$custom_css.=$rule.';';
				endforeach;
				$custom_css.='}';
			endif;
		endif;
        
        //call css on header
        wp_register_style( $component_id.'-css', false );
        wp_enqueue_style( $component_id.'-css' );
        wp_add_inline_style( $component_id.'-css', $custom_css );
        
		$content=wpb_js_remove_wpautop( $content );
        if($content)$content='<div class="vc-contentbox-text">' . $content . '</div>';
        
        $btn_html='';
        if(!empty($btn_link) && !empty($btn_text))$btn_html='<div class="vc-contentbox-btn-holder '.$btn_align.'"><div id="'.$btn_id.'" class="vc-contentbox-btn btn '.$btn_class.'">'.$btn_link.'</div></div>';
		
        $html = '
        <div class="vc-contentbox-wrap" id="'.$component_id.'">
            ' . $content . '
            '.$btn_html.'
        </div>';
        return $html;
    }
     
}
new contentBox();