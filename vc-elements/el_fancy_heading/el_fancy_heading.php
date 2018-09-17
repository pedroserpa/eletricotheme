<?php
/*
Element Description: Fancy Heading
*/
class fancyHeading extends WPBakeryShortCode {
    function __construct() {
        add_action( 'init', array( $this, 'el_fancy_heading_mapping' ) );
        add_shortcode( 'el_fancy_heading', array( $this, 'el_fancy_heading_html' ) );
    }
     
    // Element Mapping
    public function el_fancy_heading_mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
        vc_map( 
            array(
                'name' => __('Fancy Heading', 'hipercriativo'),
                'base' => 'el_fancy_heading',
                'icon' => 'icon-el-fancy-heading vc_mk_element-icon',
                'description' => __('Custom fancy heading text', 'hipercriativo'), 
                'category' => __('Content', 'hipercriativo'),        
                "params" => array(
				    array(
                        "type" => "textarea_html",
                        "heading" => __("Text", "hipercriativo"),
						"holder" => "div",
                        "param_name" => "content",
                        "value" => __( "<span>I am test text block. Click edit button to change this text.</span>", "hipercriativo" ),
                    ),
					array(
                        "type" => "dropdown",
                        "heading" => __("HTML Tag", "hipercriativo"),
                        "description" => __("", "hipercriativo"),
                        "param_name" => "html_tag",
                        "value" => array(
                            __('H1','hipercriativo') => 'h1',
                            __('H2','hipercriativo') => 'h2',
                            __('H3','hipercriativo') => 'h3',
                            __('H4','hipercriativo') => 'h4',
                            __('H5','hipercriativo') => 'h5',
                            __('H6','hipercriativo') => 'h6',
                            __('SPAN','hipercriativo') => 'span',
                        )
                    ),
                     array(
                        'type' => 'checkbox',
                        'heading' => __( 'Use theme default font family?', 'hipercriativo' ),
                        'param_name' => 'use_theme_fonts',
                        'value' =>__( 'true', 'hipercriativo' ),
                        'admin_label' => false
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
						),
                        "dependency" => array(
                            "element" => "use_theme_fonts",
                            "value" => array("false")
                        )
					),
					array(
                        "type" => "colorpicker",
                        "heading" => __("Text Color", "hipercriativo"),
                        "param_name" => "text_color",
                        "value" => ""
                    ),
					array(
                        "type" => "dropdown",
                        "heading" => __("Text Alignment", "hipercriativo"),
                        "param_name" => "text_align",
                        "value" => "text-left",
						"value" => array(
                            __('Align left','hipercriativo') => 'text-left',
                            __('Align center','hipercriativo') => 'text-center',
                            __('Align right','hipercriativo') => 'text-right'
                        ),
                    ),
                    array(
                        "type" => "numberfield",
                        "heading" => __("Font Size (Px)", "hipercriativo"),
                        "param_name" => "font_size",
                        "value" => "40",
                        "min" => "9",
                        "max" => "180",
                        "step" => "1",
                        "unit" => 'px'
                    ),
					array(
                        "type" => "numberfield",
                        "heading" => __("Responsive Font Size (Px)", "hipercriativo"),
                        "param_name" => "responsive_font_size",
                        "value" => "20",
                        "min" => "9",
                        "max" => "80",
                        "step" => "1",
                        "unit" => 'px',
						"description" => __("Below 767px pixels width", "hipercriativo"),
                    ),
					array(
                        "type" => "numberfield",
                        "heading" => __("Line Height (Px)", "hipercriativo"),
                        "param_name" => "line_height",
                        "value" => "12",
                        "min" => "0",
                        "max" => "180",
                        "step" => "1",
                        "unit" => 'px'
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
     
    public function el_fancy_heading_html( $atts,$content = null ) {
		
        extract(
            shortcode_atts(
                array(
					'html_tag'=>'h2',
                    'use_theme_fonts'=>'true',
                    'google_fonts'=>'',
					'text_align'=>'text-left',
					'text_color'=>'',
                    'font_size'=> '40',
                    'responsive_font_size' 	=> '20',
					'line_height'=>'',
                    'visibility'=>'',
                    'responsive_rules'=>0
                ), 
                $atts
            )
        );
        
        $component_id='el_fancy_heading-'.uniqid();
        
        $custom_css='';
        if(!empty($font_size)){
            $custom_css.='#'.$component_id.', #'.$component_id.' '.$html_tag.' {font-size:'.$font_size.'px;}';
        }
		if(!empty($responsive_font_size)){
            $custom_css.='@media screen and (max-width:767px){#'.$component_id.', #'.$component_id.' '.$html_tag.'{font-size:'.$responsive_font_size.'px!important;}}';
        }
		if(!empty($text_color)){
            $custom_css.='#'.$component_id.'{color:'.$text_color.'px;}';
        }
		if(!empty($line_height)){
            $custom_css.='#'.$component_id.'{line-height:'.$line_height.'px;}';
        }
		if(!empty($google_fonts)&&$use_theme_fonts!='true')
		{
			$google_fonts=new Eletrico_vc_custom_google_fonts($atts);
			if($google_fonts->style&&is_array($google_fonts->style)):
				$custom_css.='#'.$component_id.', #'.$component_id.' '.$html_tag.'{';
				foreach($google_fonts->style as $rule):
					$custom_css.=$rule.';';
				endforeach;
				$custom_css.='}';
			endif;
		}
		
		$content = wpb_js_remove_wpautop($content, true); 
		
		wp_register_style( 'electrico-style-css', false );
		wp_enqueue_style( 'electrico-style-css' );
		wp_add_inline_style( 'electrico-style-css', $custom_css );
        $html = '<div id="'.$component_id.'" class="el-fancy-heading '.$text_align.' ';
        $html.=((!empty($visibility))?' '.$visibility:'').'';
        $html.='"><'.$html_tag.'>'.strip_tags($content,'<br><a><span>').'</'.$html_tag.'></div>';
        return $html;
    }
}
new fancyHeading();