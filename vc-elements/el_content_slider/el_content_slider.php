<?php
/*
Element Description: News Carousel
*/

class eletricoContentCarousel extends WPBakeryShortCode {
    function __construct() {
        add_action( 'init', array( $this, 'eletrico_content_carousel_mapping' ) );
        add_shortcode( 'eletrico_content_carousel', array( $this, 'eletrico_content_carousel_html' ) );
    }
     
    // Element Mapping
    public function eletrico_content_carousel_mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
        vc_map( 
            array(
                'name' => __('Eletrico Content Slider', 'hipercriativo'),
                'base' => 'eletrico_content_carousel',
                'icon' => 'icon-el-carousel vc_mk_element-icon',
                'description' => __('Advanced Content Carousel', 'hipercriativo'), 
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
     
    public function eletrico_content_carousel_html( $atts ) {
        global $wpdb;
        extract(
            shortcode_atts(
                array(
                    'title'   => '',
                    'text' => '',
                    'image_size' => 'large',
                    'image_width' => '',
                    'image_height' => '',
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
            
                //$img=wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
                $attachment_id=get_post_thumbnail_id( get_the_ID());
                if($image_size&&$image_size=='large'){
                    $img=wp_get_attachment_image_src ( $attachment_id , '16_9_large' );
                    if($img)$img=$img[0];
                    else $img=wp_get_attachment_url($attachment_id);
                }
                if($image_size&&$image_size=='custom'&&!empty($image_width)&&!empty($image_height)){
                    $img=wp_get_attachment_url($attachment_id);
                    if($img){
                    $params = array( 'width' => intval($image_width), 'height' => intval($image_height), 'crop'=>true, 'quality'=>100 );
                    $img=bfi_thumb( $img, $params );
                    }else $img=wp_get_attachment_image_src( $attachment_id, '16_9_large' );
                }
                else $img=wp_get_attachment_url($attachment_id);

                $imgs.='
                <div class="item" id="slick-item-'.$i.'">
                    <div class="imageContainer">
                      <img src="'.urldecode($img).'" />
                      <div class="copy-container">
            
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col col-xs-12 text-center btn-wrapper">
                              <h1>'.get_the_title().'</h1>
                              <p>'.get_the_content().'</p>';
                              /*if(get_the_title()!=''&&$slide['btn_url']&&!empty($slide['btn_url'])):
                              $imgs.='<a href="'.(($slide['btn_url'])?$slide['btn_url']:'#').'" role="button" class="btn '.$slide['btn_style'].'">
                                '.(($slide['btn_text'])?$slide['btn_text']:__('Read more','hipercriativo')).'
                              </a>';
                              endif;*/
                            $imgs.='</div>
            
                          </div>
                        </div>
            
                      </div>
                    </div>
                  </div>';
            
            endwhile;
        endif;    
        wp_reset_postdata();
        
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
new eletricoContentCarousel();