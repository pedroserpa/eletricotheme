<?php
/*
Element Description: Posts Mosaic Box
*/
 
// Element Class 
class eletricoMosaicBox extends WPBakeryShortCode {
    function __construct() {
        add_action( 'init', array( $this, 'elmosaic_mapping' ) );
        add_shortcode( 'elmosaic', array( $this, 'elmosaic_html' ) );
    }
     
    // Element Mapping
    public function elmosaic_mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
        vc_map( 
            array(
                'name' => __('Portfolio Category Mosaic', 'hipercriativo'),
                'base' => 'elmosaic',
                'icon' => 'icon-el-mosaic vc_mk_element-icon',
                /*'category' => __('My Custom Elements', 'hipercriativo'), */  
                /*'icon' => get_template_directory_uri().'/assets/images/vc-icon.png', */           
                'params' => array(
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Gallery style', 'hipercriativo' ),
                        'param_name' => 'gal_style',
                        'value' =>
                        array(
                            'Masonry'   => 'masonry',
                            'Classic Grid' => 'grid',
                            'Puzzle Grid' => 'puzzle'
                        ),
                        'description' => __( 'Choose a display style for your gallery', 'hipercriativo' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Content',
                    ),  
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
                        'type' => 'colorpicker',
                        /*'class' => 'button-class',*/
                        'heading' => __( 'Title Color', 'hipercriativo' ),
                        'param_name' => 'title_color',
                        'value' =>__( '#FFFFFF', 'hipercriativo' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Content','dependency' => 'title'
                    ),
                    array(
                        'type' => 'checkbox',
                        /*'class' => 'button-class',*/
                        'heading' => __( 'Border padding', 'hipercriativo' ),
                        'param_name' => 'border_padding',
                        'value' =>false,
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Content',
                    ),
                    /*array(
                        'type' => 'dropdown',
                        'heading' => __( 'Post type category', 'hipercriativo' ),
                        'param_name' => 'cat',
                        'value' =>$this->elmosaic_portfolio_categories(),
                        'description' => __( 'Choose a post type to display', 'hipercriativo' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Content',
                    ),*/
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Button Style', 'hipercriativo' ),
                        'param_name' => 'btn_style',
                        'value' =>
                        array(
                                'Flat'   => 'btn-flat',
                                'Rounded' => 'btn-rounded',
                                'Circle'  => 'btn-circle',
                                'Outline'   => 'btn-outline'
                        ),
                        'description' => __( 'Button Appearance', 'hipercriativo' ),
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
                    /*array(
                        'type' => 'numberfield',
                        'heading' => __( 'How many posts', 'hipercriativo' ),
                        'param_name' => 'plimit',
                        'value' =>__( '3', 'hipercriativo' ),
                        'min' =>1,
                        'max' =>4,
                        'description' => __( 'Maximum number of posts to display', 'hipercriativo' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Content'
                    ), */
                ),
            )
        );       
    }
    
    public function elmosaic_portfolio_categories() {
        /*global $wpdb;
        $output = 'objects';
        $cats=array();
        $terms = get_terms( array(
            'taxonomy' => 'portfolio_cat',
            'hide_empty' => false,
        ) );
        if($terms)
        {   
            foreach($terms as $cat):
            $cats[$cat->name]=$cat->term_id;
            endforeach;
        }
        return $cats;
        */
    }
     
    public function elmosaic_html( $atts ) {
        global $wpdb;
        extract(
            shortcode_atts(
                array(
                    'gal_style'=>'',
                    'title'   => '',
                    'title_color'   => '',
                    'border_padding'=>'',
                    /*'cat' => '',*/
                    'btn_style' => '',
                    'btn_align' => 'text-center',
                    'btn_text_color' => '',
                    'btn_color' => '',
                    'btn_hover_color' => '',
                ), 
                $atts
            )
        );
        
        $component_id='vc-elmosaic-'.uniqid();
        
        $custom_css=$css_class='';
        if(!empty($title_color)){
            $custom_css.='#'.$component_id.' h3{color:'.$title_color.';}';
        }
        if(!empty($btn_text_color))$custom_css.='#'.$component_id.' a, #'.$component_id.' a span{color:'.$btn_text_color.';}';
        if(!empty($btn_text_color)&&empty($btn_color))$custom_css.='#'.$component_id.' a:focus, #'.$component_id.' a:active{-webkit-box-shadow: 0px 0px 5px 0px '.$btn_text_color.';-moz-box-shadow: 0px 0px 5px 0px '.$btn_text_color.';box-shadow: 0px 0px 5px 0px '.$btn_text_color.';}';
        if(!empty($btn_style))
        {
            if($btn_style=='btn-outline')
            {
               if(!empty($btn_color)){
                    $custom_css.='#'.$component_id.' a.btn{background-color:transparent;border:1px solid '.$btn_color.';}';
                    $custom_css.='#'.$component_id.' a.btn:focus,#'.$component_id.' a.btn:active{-webkit-box-shadow: 0px 0px 5px 0px '.$btn_color.';-moz-box-shadow: 0px 0px 5px 0px '.$btn_color.';box-shadow: 0px 0px 5px 0px '.$btn_color.';}';
               }
               if(!empty($btn_hover_color))$custom_css.='#'.$component_id.' a.btn:hover{background-color:transparent;color:'.$btn_hover_color.';border:1px solid '.$btn_hover_color.';}';
            }
            else
            {
            if(!empty($btn_color)){
                $custom_css.='#'.$component_id.' a.btn{background-color:'.$btn_color.';}';
                $custom_css.='#'.$component_id.' a.btn{background-color:transparent;border:1px solid '.$btn_color.';}';
            }
            if(!empty($btn_hover_color))$custom_css.='#'.$component_id.' a.btn:hover{background-color:'.$btn_hover_color.';}';
            }
        }
        if(!empty($border_padding)&&$border_padding!=='false')$css_class=' bordered';
        
        //call css on header
        wp_register_style( $component_id.'-css', false );
        wp_enqueue_style( $component_id.'-css' );
        wp_add_inline_style( $component_id.'-css', $custom_css );
        
        $terms = get_terms( array(
            'taxonomy' => 'portfolio_cat',
            'hide_empty' => false,
        ) );
        $i=$total=0;
        $html='';
        $html .= '<div class="vc-eletrico_mosaic-wrap">';
        if(!empty($title))$html .= '<h2 class="vc-eletrico_mosaic-title">' . $title . '</h2>';
        $html .= '<div class="vc-eletrico_mosaic" id="'.$component_id.'">';
               if($terms){
                $total=count($terms);
                $html .= '<div class="vc_row wpb_row">';
                
                  if($gal_style&&$gal_style=='masonry')$html .= '<div class="wpb_column vc_column_container vc_col-sm-12 '.$css_class.'"><div class="masonry">';
                  foreach($terms as $cat):
                        $image_id = get_term_meta ( $cat->term_id, 'showcase-taxonomy-image-id', true );
                        if($gal_style&&$gal_style==='masonry'):
                            if($i==21)$i=0;
                                    $html .= '<div id="portfolio_cat-'.$cat->term_id.'" class="vc-eletrico_mosaic-item '.$css_class.' vc-eletrico_mosaic-masonry-item '.(($i==2 || $i==7|| $i==12|| $i==17)?'vc-eletrico_mosaic-item--2':'').'">';
                                        if($image_id){
                                        if( $i==2 || $i==7|| $i==12|| $i==17 )$html .= wp_get_attachment_image ( $image_id, '9_16_thumbs' );
                                        else $html .= wp_get_attachment_image ( $image_id, '16_9_thumbs' );
                                        }
                                        $html .= '<div class="vc-eletrico_mosaic-item-overlay">';
                                        $html .= '<div class="vc-eletrico_mosaic-item-overlay-content">';
                                        $html .= '<h3 class="vc-eletrico_mosaic-item-title">'.$cat->name.'</h3>';
                                        $html .= '<a class="btn '.$btn_style.' vc-eletrico_mosaic-item-link text-uppercase" href="'.get_term_link($cat->term_id).'">'.__('Ver mais','hipercriativo').'</a>';
                                        $html .= '</div>';
                                        $html .= '</div>';
                                    $html .= '</div>';
                        else:
                            $html .= '<div class="wpb_column vc_column_container vc_col-sm-6 '.$css_class.'">';
                            $html .= '<div class="vc_column-inner text-center">';
                                $html .= '<div id="portfolio_cat-'.$cat->term_id.'" class="vc-eletrico_mosaic-item">';
                                    if($image_id)$html .= wp_get_attachment_image ( $image_id, '16_9_thumbs','',["class" => "img-fluid"] );
                                    $html .= '<div class="vc-eletrico_mosaic-item-overlay">';
                                    $html .= '<div class="vc-eletrico_mosaic-item-overlay-content">';
                                    $html .= '<h3 class="vc-eletrico_mosaic-item-title">'.$cat->name.'</h3>';
                                    $html .= '<a class="btn '.$btn_style.' vc-eletrico_mosaic-item-link text-uppercase" href="'.get_term_link($cat->term_id).'">'.__('Ver mais','hipercriativo').'</a>';
                                    $html .= '</div>';
                                    $html .= '</div>';
                                $html .= '</div>';
                            $html .= '</div>';
                            $html .= '</div>';
                        endif;
                        
                    $i++;
                  endforeach;
                  if($gal_style&&$gal_style=='masonry')$html .= '</div></div>';
                  
                  
                $html .= '</div>';//end row
              }//end if $terms
        $html .= '</div></div>';
        return $html;
    }
     
}
new eletricoMosaicBox();