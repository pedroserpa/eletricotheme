<?php
/*
Element Description: Video Mosaic Box
*/
 
// Element Class 
class eletricoVideoMosaicBox extends WPBakeryShortCode {
    function __construct() {
        add_action( 'init', array( $this, 'elmosaic_video_mapping' ) );
        add_shortcode( 'elvideomosaic', array( $this, 'elmosaic_video_html' ) );
    }
     
    // Element Mapping
    public function elmosaic_video_mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
        vc_map( 
            array(
                'name' => __('Video Mosaic', 'hipercriativo'),
                'base' => 'elvideomosaic',
                'icon' => 'icon-el-mosaic vc_mk_element-icon',          
                'params' => array(
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Gallery style', 'hipercriativo' ),
                        'param_name' => 'gal_style',
                        'value' =>
                        array(
                                'Masonry'   => 'masonry',
                                'Grid' => 'grid'
                        ),
                        'description' => __( 'Choose a style to display your gallery', 'hipercriativo' ),
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
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Button link', 'hipercriativo' ),
                        'param_name' => 'btn_link',
                        'value' =>
                        array(
                                'To category'   => 'cat',
                                'To post' => 'post'
                        ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Button',
                    )
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

    public function getVideoThumbnail($video_url)
    {
        if(!$video_url)return false;
        $video_id=str_replace('https://www.youtube.com/watch?v=','',$video_url);
        if($video_id):
            return 'https://img.youtube.com/vi/'.$video_id.'/0.jpg';
        endif;
        return false;
    }
     
    public function elmosaic_video_html( $atts ) {
        global $wpdb;
        extract(
            shortcode_atts(
                array(
                    'gal_style'=>'masonry',
                    'title'   => '',
                    'title_color'   => '',
                    'border_padding'=>'',
                    'cat' => '',
                    'btn_style' => '',
                    'btn_align' => 'text-center',
                    'btn_text_color' => '',
                    'btn_color' => '',
                    'btn_hover_color' => '',
                    'btn_link' => 'cat',
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
        
        $args = array(
        'post_type'=> 'video-posts',
        'post_status'    => 'publish',
        'order'    => 'DESC'
        );
    
        $videos = query_posts( $args );
        $i=$total=0;
        global $wp_query; 
         $total= $wp_query->found_posts;
        $html = '';
        $html .= '<div class="vc-eletrico_mosaic-wrap">';
        if(!empty($title))$html .= '<h2 class="vc-eletrico_mosaic-title">' . $title . '</h2>';
        $html .= '<div class="vc-eletrico_mosaic" id="'.$component_id.'">';
               if($videos){
                $html .= '<div class="vc_row wpb_row">';
                  if($gal_style=='masonry')$html .= '<div class="wpb_column vc_column_container vc_col-sm-12 '.$css_class.'"><div class="masonry">';
                  foreach($videos as $post):
                    //$post->the_post(); 
                    setup_postdata( $post );
                        $image_id = get_post_thumbnail_id ( $post->ID );
                        $video_url = get_post_meta( $post->ID, 'wp_video_url', true );
                        $cat_id=$cat_name=null;
                        $cats=get_the_terms($post->ID,'video_cat');
                        if($cats):
                            $cat_id=$cats[0]->term_id;
                            $cat_name=$cats[0]->name;
                        endif;
                        if($gal_style&&$gal_style=='masonry'){
                            if($i>4)$i=0;
                                    $html .= '<div id="video_item-'.$post->ID.'" class="vc-eletrico_mosaic-item';
                                     if( $i==0 || $i==4 )$html .= ' vc-eletrico_mosaic-item--2';
                                     $html .= '">';
                                        if($image_id){
                                        if( $i==0 || $i==4 )$html .= wp_get_attachment_image ( $image_id, '16_9_thumbs' );
                                        else $html .= wp_get_attachment_image ( $image_id, '9_16_thumbs' );
                                        }
                                        $html .= '<div class="vc-eletrico_mosaic-item-overlay">';
                                        $html .= '<div class="vc-eletrico_mosaic-item-overlay-content">';
                                        $html .= '<h3 class="vc-eletrico_mosaic-item-title">'.$post->post_title.'</h3>';
                                        if($btn_link&&$btn_link=='cat'&&!is_null($cat_id))$html .= '<a class="btn '.$btn_style.' vc-eletrico_mosaic-item-link text-uppercase" href="'.get_term_link($cat_id).'">'.__('Ver mais','hipercriativo').'</a>';
                                        else $html .= '<a class="btn '.$btn_style.' vc-eletrico_mosaic-item-link text-uppercase" href="'.get_permalink($post->ID).'">'.__('Ver mais','hipercriativo').'</a>';
                                        $html .= '</div>';
                                        $html .= '</div>';
                                    $html .= '</div>';
                         }else{
                            $html .= '<div class="wpb_column vc_column_container vc_col-sm-4 '.$css_class.'">';
                            $html .= '<div class="vc_column-inner text-center">';
                                $html .= '<div id="video_item-'.$post->ID.'" class="vc-eletrico_mosaic-item">';
                                    if($image_id)$html .= wp_get_attachment_image ( $image_id, '16_9_thumbs','',["class" => "img-fluid"] );
                                    elseif(!empty($video_url)&&$this->getVideoThumbnail($video_url)!==false)$html .= '<img src="'.$this->getVideoThumbnail($video_url).'" class="img-fluid">';
                                    $html .= '<div class="vc-eletrico_mosaic-item-overlay">';
                                    $html .= '<div class="vc-eletrico_mosaic-item-overlay-content">';
                                    if($btn_link&&$btn_link=='cat'&&!is_null($cat_id))$html .= '<a class="btn '.$btn_style.' vc-eletrico_mosaic-item-link text-uppercase" href="'.get_term_link($cat_id).'">'.__('Ver mais','hipercriativo').'</a>';
                                    else $html .= '<a class="btn '.$btn_style.' vc-eletrico_mosaic-item-link text-uppercase" href="'.get_permalink($post->ID).'">'.__('Ver mais','hipercriativo').'</a>';
                                    $html .= '</div>';
                                    $html .= '</div>';
                                $html .= '</div>';
                            $html .= '</div>';
                            $html .= '</div>';
                        }
                    $i++;
                  endforeach;
                  wp_reset_postdata();
                  wp_reset_query(); 
                  if($gal_style=='masonry')$html .= '</div></div>';
                  
                $html .= '</div>';//end row
              }//end if $terms
        $html .= '</div></div>';
        return $html;
    }
     
}
new eletricoVideoMosaicBox();