<?php
/*
Element Description: Portfolio Mosaic Box
*/
 
// Element Class 
class eletricoFolioMosaicBox extends WPBakeryShortCode {
    public $initPostNr,$offsetPosts;
    function __construct() {
        $this->initPostNr=6;
        $this->offsetPosts=0;
        add_action( 'init', array( $this, 'elmosaic_folio_mapping' ) );
        add_shortcode( 'elfoliomosaic', array( $this, 'elmosaic_folio_html' ) );
        //add_action( 'wp_ajax_elmosaic_folio_ajax', array( $this, 'elmosaic_folio_ajax') );
		add_action( 'wp_ajax_folio_loadmore', array( $this, 'elmosaic_folio_ajax') );
		add_action( 'wp_ajax_nopriv_folio_loadmore', array( $this, 'elmosaic_folio_ajax') );
        if(!is_admin())add_action( 'wp_footer', array($this,'elmosaic_folio_ajax_load_more') );
    }
     
    // Element Mapping
    public function elmosaic_folio_mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
        vc_map( 
            array(
                'name' => __('Portfolio Mosaic', 'hipercriativo'),
                'base' => 'elfoliomosaic',
                'icon' => 'icon-el-mosaic vc_mk_element-icon',          
                'params' => array(
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Gallery style', 'hipercriativo' ),
                        'param_name' => 'gal_style',
                        'value' =>
                        array(
                                'Masonry'   => 'masonry',
                                'Puzzle' => 'puzzle',
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
    public function elmosaic_folio_ajax() {
        global $wpdb;
    
		if(isset($_POST['load_more'])&&intval($_POST['load_more'])>0)
		{
			$btn_link=(isset($_POST['btn_link'])?$_POST['btn_link']:'');
			$btn_style=(isset($_POST['btn_style'])?$_POST['btn_style']:'');
			$html='';
			$limit = $this->initPostNr;
			$offset = $this->offsetPosts=$this->offsetPosts+6;
		
			$args = array(
			'post_type'=> 'folio',
			'post_status'    => 'publish',
			'offset' => $offset,
			'posts_per_page' => $limit,
			'order'    => 'DESC'
			);
			$folios = query_posts( $args );
			$i=$total=0;
			global $wp_query; $total= $wp_query->found_posts;
			if($folios)
			{
				foreach($folios as $post):
					setup_postdata( $post );
					$image_id = get_post_thumbnail_id ( $post->ID );
					$cats=get_the_terms($post->ID,'portfolio_cat');
					if($cats):
						$cat_id=$cats[0]->term_id;
						$cat_name=$cats[0]->name;
					else :
					$cat_id=$cat_name=null;
					endif;
					if( $i==0 )$html .= '<div class="vc_col-sm-8 pl-0 pr-0">';
					if( $i==1 )$html .= '<div class="vc_row wpb_row"><div class="vc_col-sm-6 pr-0">';
						$html .= '<div id="portfolio_item-'.$post->ID.'" class="vc-eletrico_mosaic-item">';
							if($image_id){
							if( $i==0 || $i==3 )$img_src = wp_get_attachment_image_src ( $image_id, '16_3_thumbs' );
							else $img_src = wp_get_attachment_image_src ( $image_id, '5_10_thumbs' );
							$html .= '<img src="'.$img_src[0].'" class="img-fluid">';
							}
							$html .= '<div class="vc-eletrico_mosaic-item-overlay"><div class="vc-eletrico_mosaic-item-overlay-content">';
							if($btn_link&&$btn_link=='cat'&&!is_null($cat_id))$html .= '<h3 class="vc-eletrico_mosaic-item-title">'.$cat_name.'</h3>';
							else $html .= '<h3 class="vc-eletrico_mosaic-item-title">'.$post->post_title.'</h3>';
						   
							if($btn_link&&$btn_link=='cat'&&!is_null($cat_id))$html .= '<a class="btn '.$btn_style.' vc-eletrico_mosaic-item-link text-uppercase" href="'.get_term_link($cat_id).'">'.__('Ver mais','hipercriativo').'</a>';
							else $html .= '<a class="btn '.$btn_style.' vc-eletrico_mosaic-item-link text-uppercase" href="'.get_permalink($post->ID).'">'.__('Ver mais','hipercriativo').'</a>';
							$html .= '</div></div>';
						$html .= '</div>';
					if( $i==1 )$html .= '</div><div class="vc_col-sm-6 pl-0">'; 
					if( $i==2 )$html .= '</div>';  //end col6 
					if( $i==2 )$html .= '</div>';  //end row 
					if( $i==3 )$html .= '</div>';
				$i++;
				endforeach;
				wp_reset_postdata();
                wp_reset_query(); 
				ob_clean();echo json_encode(array('html'=>$html,'totalPosts'=>$total,'curCount'=>$i));
			}
		}
        wp_die();
    }
    public function elmosaic_folio_ajax_load_more() {
        //global $wpdb;
        ?>
        <script type="text/javascript">
        var load_more=1;
        jQuery(document).ready(function() {
            jQuery('.btn-loadmore').on('click',function(e)
            {
				//load_more=1;
				e.preventDefault();
				var $this=jQuery(this);
                var target=$this.data('target');
                var btn_link=$this.data('btn_link');
                var btn_style=$this.data('btn_style');
				if(!target)return false;
				$this.attr('disabled',true);
				var data = {
					'action': 'folio_loadmore',
					'load_more': load_more,
					'btn_link':btn_link,
					'btn_style':btn_style
				};
				jQuery.ajax({
					url : '<?php echo get_bloginfo('url') . '/wp-admin/admin-ajax.php';?>',
					data : data,
					dataType : 'json',
					type : 'POST',
					beforeSend : function ( xhr ) {
						
					},
					success : function( response ){
						if( response&&response.html ) {
							jQuery(target).append(response.html);
							if(response.curCount===response.total-1)$this.fadeOut();
						} 
						
						$this.removeAttr('disabled');
					}
				});
            });
        });
        </script>
        <?php
    }
    public function elmosaic_folio_html( $atts ) {
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
        'post_type'=> 'folio',
        'post_status'    => 'publish',
        'order'    => 'DESC'
        );
        
        if($gal_style&&$gal_style=='puzzle')$args['posts_per_page']=6;
    
        $folios = query_posts( $args );
        $i=$total=0;
        global $wp_query; 
         $total= $wp_query->found_posts;
        $html = '';
        $html .= '<div class="vc-eletrico_mosaic-wrap">';
        if(!empty($title))$html .= '<h2 class="vc-eletrico_mosaic-title">' . $title . '</h2>';
        $html .= '<div class="vc-eletrico_mosaic" id="'.$component_id.'">';
               if($folios){
                $html .= '<div id="'.$component_id.'-ajaxHolder" class="vc_row wpb_row '.(($gal_style=='puzzle')?$css_class:'').'">';
                  if($gal_style=='masonry')$html .= '<div class="wpb_column vc_column_container vc_col-sm-12 '.$css_class.'"><div class="masonry">';
                  foreach($folios as $post):
                    //$post->the_post(); 
                    setup_postdata( $post );
                        $image_id = get_post_thumbnail_id ( $post->ID );
                        $cats=get_the_terms($post->ID,'portfolio_cat');
                        if($cats):
                            $cat_id=$cats[0]->term_id;
                            $cat_name=$cats[0]->name;
                        else :
                        $cat_id=$cat_name=null;
                        endif;
                        if($gal_style&&$gal_style=='masonry'){
                            if($i>4)$i=0;
                                    $html .= '<div id="portfolio_item-'.$post->ID.'" class="vc-eletrico_mosaic-item';
                                     if( $i==0 || $i==4 )$html .= ' vc-eletrico_mosaic-item--2';
                                     $html .= '">';
                                        if($image_id){
                                        if( $i==0 || $i==4 )$html .= wp_get_attachment_image ( $image_id, '16_9_thumbs' );
                                        else $html .= wp_get_attachment_image ( $image_id, '9_16_thumbs' );
                                        }
                                        $html .= '<div class="vc-eletrico_mosaic-item-overlay">';
                                        $html .= '<div class="vc-eletrico_mosaic-item-overlay-content">';
                                        $html .= '<h3 class="vc-eletrico_mosaic-item-title">'.$post->post_title.'</h3>';
                                        if($btn_link&&$btn_link=='cat')$html .= '<a class="btn '.$btn_style.' vc-eletrico_mosaic-item-link text-uppercase" href="'.get_term_link($cat_id).'">'.__('Ver mais','hipercriativo').'</a>';
                                        else $html .= '<a class="btn '.$btn_style.' vc-eletrico_mosaic-item-link text-uppercase" href="'.get_permalink($post->ID).'">'.__('Ver mais','hipercriativo').'</a>';
                                        $html .= '</div>';
                                        $html .= '</div>';
                                    $html .= '</div>';
                         }elseif($gal_style&&$gal_style=='puzzle'&&$total>5){
                            if( $i==0 )$html .= '<div class="vc_col-sm-8 pl-0 pr-0">';
                            
                            //if( $i==3 )$html .= '</div><div class="vc_col-sm-3">';
                                if( $i==1 )$html .= '<div class="vc_row wpb_row"><div class="vc_col-sm-6 pr-0">';
                                    $html .= '<div id="portfolio_item-'.$post->ID.'" class="vc-eletrico_mosaic-item">';
                                        if($image_id){
                                        if( $i==0 || $i==3 )$img_src = wp_get_attachment_image_src ( $image_id, '16_3_thumbs' );
                                        else $img_src = wp_get_attachment_image_src ( $image_id, '5_10_thumbs' );
                                        $html .= '<img src="'.$img_src[0].'" class="img-fluid">';
                                        } 
                                        $html .= '<div class="vc-eletrico_mosaic-item-overlay"><div class="vc-eletrico_mosaic-item-overlay-content">';
                                        if($btn_link&&$btn_link=='cat'&&!is_null($cat_id))$html .= '<h3 class="vc-eletrico_mosaic-item-title">'.$cat_name.'</h3>';
                                        else $html .= '<h3 class="vc-eletrico_mosaic-item-title">'.$post->post_title.'</h3>';
                                       
                                        if($btn_link&&$btn_link=='cat'&&!is_null($cat_id))$html .= '<a class="btn '.$btn_style.' vc-eletrico_mosaic-item-link text-uppercase" href="'.get_term_link($cat_id).'">'.__('Ver mais','hipercriativo').'</a>';
                                        else $html .= '<a class="btn '.$btn_style.' vc-eletrico_mosaic-item-link text-uppercase" href="'.get_permalink($post->ID).'">'.__('Ver mais','hipercriativo').'</a>';
                                        $html .= '</div></div>';
                                    $html .= '</div>';
                                if( $i==1 )$html .= '</div><div class="vc_col-sm-6 pl-0">'; 
                                if( $i==2 )$html .= '</div>';  //end col6 
                                if( $i==2 )$html .= '</div>';  //end row 
                            
                            if( $i==3 )$html .= '</div>';//end col8
                            
                        }else{
                            $html .= '<div class="wpb_column vc_column_container vc_col-sm-6 '.$css_class.'">';
                            $html .= '<div class="vc_column-inner text-center">';
                                $html .= '<div id="portfolio_item-'.$post->ID.'" class="vc-eletrico_mosaic-item">';
                                    if($image_id)$html .= wp_get_attachment_image ( $image_id, '16_9_thumbs','',["class" => "img-fluid"] );
                                    $html .= '<div class="vc-eletrico_mosaic-item-overlay">';
                                    $html .= '<div class="vc-eletrico_mosaic-item-overlay-content">';
                                    if($btn_link&&$btn_link=='cat')$html .= '<a class="btn '.$btn_style.' vc-eletrico_mosaic-item-link text-uppercase" href="'.get_term_link($cat_id).'">'.__('Ver mais','hipercriativo').'</a>';
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
				if($gal_style=='puzzle'&&$i>=3 && $total>5)$html .='<div class="load_more_holder text-center mt-3"><button data-target="#'.$component_id.'-ajaxHolder" data-link="'.(($btn_link)?$btn_link:'').'" data-style="'.(($btn_style)?$btn_style:'').'" type="button" class="btn '.$btn_style.' btn-loadmore vc-eletrico_mosaic-item-link text-uppercase">'.__('Ver mais','hipercriativo').'</button></div>';
                  
              }//end if $folios
        $html .= '</div></div>';
        return $html;
    }
     
}
new eletricoFolioMosaicBox();