<?php
/*
Element Description: News Carousel
*/

class eletricoNewsCarousel extends WPBakeryShortCode {
    function __construct() {
        add_action( 'init', array( $this, 'eletrico_news_carousel_mapping' ) );
        add_shortcode( 'eletrico_news_carousel', array( $this, 'eletrico_news_carousel_html' ) );
    }
     
    // Element Mapping
    public function eletrico_news_carousel_mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
        vc_map( 
            array(
                'name' => __('VW News Slider', 'hipercriativo'),
                'base' => 'eletrico_news_carousel',
                'icon' => 'icon-el-carousel vc_mk_element-icon',
                'description' => __('Advanced News Carousel', 'hipercriativo'), 
                /*'category' => __('My Custom Elements', 'hipercriativo'), */  
                /*'icon' => get_template_directory_uri().'/assets/images/vc-icon.png', */           
                
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
                                'type' => 'dropdown',
                                'heading' => __( 'Content type', 'hipercriativo' ),
                                'param_name' => 'ptype',
                                'value' =>
                                array(
                                        'Posts'   => 'post',
                                        'Video'   => 'video-posts',
                                        'Folio'   => 'folio',
                                ),
                                'admin_label' => false,
                                'weight' => 0,
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __( 'Order By', 'hipercriativo' ),
                                'param_name' => 'order_by',
                                'value' =>
                                array(
                                        'ID'   => 'ID',
                                        'Date'   => 'date'
                                ),
                                'admin_label' => false,
                                'weight' => 0,
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __( 'Order', 'hipercriativo' ),
                                'param_name' => 'order',
                                'value' =>
                                array(
                                        'Ascending'   => 'ASC',
                                        'Descending'   => 'DESC'
                                ),
                                'admin_label' => false,
                                'weight' => 0,
                            ),
                        )
                    
                
            )
        );       
    }
     
    public function eletrico_news_carousel_html( $atts ) {
        global $wpdb;
        extract(
            shortcode_atts(
                array(
                    'title'   => '',
                    'text' => '',
                    'ptype' => 'post',
                    'order_by'=>'ID',
                    'order' => 'ASC'
                ), 
                $atts
            )
        );
        
        $component_id='vc-slick_news_carousel-'.uniqid();
        
        $imgs='';
        $slides = new WP_Query( array('post_type'=>$ptype,'order_by'=>$order_by,'order'=>$order) );
        if ( $slides->have_posts() ) :
            while ( $slides->have_posts() ) : $slides->the_post();
            
                $img=wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
                $imgs.='<div class="slick-text__inner">
            <p class="mb-5 text-left">'.get_the_date().'</p>';
                //if($img)$imgs.='<img src="'.$img.'" class="img-reponsive">';
                      $imgs.='<h2 class="mb-3 text-left">'.get_the_title().'</h2>
                      <p class="text-left">'.get_the_content().'</p>';
                      /*if(!empty($slide['btn_url']) ):
                            $imgs.='<div class="text-center btn-wrapper">
                              <a href="'.(($slide['btn_url'])?$slide['btn_url']:'#').'" role="button" class="btn '.$slide['btn_style'].'">
                                <span>'.(($slide['btn_text'])?$slide['btn_text']:__('Read more','hipercriativo')).'</span>
                              </a>
                            </div>';
                      endif;*/
                $imgs.='</div>';
            
            endwhile;
        endif;    
        wp_reset_postdata();
        
        $html = '<div class="slick-margin slick-margin--bottom" id="'.$component_id.'"><div class="row"><div class="col-md-12 heroSlider-fixed"><div class="slider slick-small slick-small--text">'.$imgs.'</div></div></div></div>';
        return $html;
     }
}
new eletricoNewsCarousel();