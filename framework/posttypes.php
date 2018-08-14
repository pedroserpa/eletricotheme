<?php
/**
 * @author Pedro Serpa
 * @copyright 2017
 */
defined( 'ABSPATH' ) OR exit;
if( ! class_exists( 'HipercriativoPostTypes' ) ) {
  class HipercriativoPostTypes {
    
    public function __construct() {
     add_action('init', array($this,'eletrico_post_types'));
    }
	public function add_portfolio_columns($defaults) {
		/*$defaults['featured_image'] = 'Featured Image';
		return $defaults;*/
		$new_order['cb'] = '<input type="checkbox" />';
		$new_order['featured_image'] = __('Featured Image');
		$new_order['title'] = __('Title');
		$new_order['taxonomy-portfolio_cat'] = __('Portfolio Categories');
		$new_order['author'] = __('Author');
		$new_order['date'] = __('Date');

		return $new_order;
	}
	public function manage_folio_columns_content($column_name, $post_ID) {
		global $wpdb;
		switch ($column_name) {
		case 'id':
			echo $post_ID;
			break;
		case 'featured_image':
			$post_featured_image = get_the_post_thumbnail( $post_ID, 'thumbnail' );
			if($post_featured_image) echo $post_featured_image ;else echo '';
			break;
		case 'title':
			echo get_the_title($post_ID);
			break;  
		case 'taxonomy-portfolio_cat':
			$terms = get_the_terms($post_ID, array('portfolio_cat'));
			if($terms){
				foreach ($terms as $term) {
					echo $term->name.',';
				}
			}
			break;
		case 'author':
			echo get_the_author($post_ID);
			break;   
		case 'date':
			echo get_the_date($post_ID);
			break;    
		default:
			break;
		}
	}
	public function eletrico_post_types()
	{
		if(!post_type_exists('folio')):
		register_post_type( 'folio',
		array(
		  'labels' => array(
				'name' => __( 'Portfolio' ),
				'singular_name' => __( 'Portfolio' ),
				'all_items'           => __( 'All Items', 'adveditor' ),
				'view_item'           => __( 'View Item', 'adveditor' ),
				'add_new_item'        => __( 'Add New Item', 'adveditor' ),
				'add_new'             => __( 'Add New', 'adveditor' ),
				'edit_item'           => __( 'Edit Portfolio', 'adveditor' ),
				'update_item'         => __( 'Update Portfolio', 'adveditor' ),
				'not_found'           => __( 'No portfolio items', 'adveditor' ),
				'not_found_in_trash'  => __( 'No portfolio items', 'adveditor' ),
		   ),
		  'public' => true,
		  'hierarchical' => true,
		  'menu_icon' => 'dashicons-portfolio',
		  'has_archive' => true,
		  'rewrite' => array('slug' => 'folio'),
		  /*'register_meta_box_cb' => 'add_events_metaboxes',*/
		  'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments')
		)
	  );
	  
	  $labels = array(
			'name'              => _x( 'Portfolio Categories', 'taxonomy general name', 'adveditor' ),
			'singular_name'     => _x( 'Portfolio Category', 'taxonomy singular name', 'adveditor' ),
			'search_items'      => __( 'Search Portfolio Categories', 'adveditor' ),
			'all_items'         => __( 'All Portfolio Categories', 'adveditor' ),
			'parent_item'       => __( 'Parent Portfolio Category', 'adveditor' ),
			'parent_item_colon' => __( 'Parent Portfolio Category:', 'adveditor' ),
			'edit_item'         => __( 'Edit Portfolio Category', 'adveditor' ),
			'update_item'       => __( 'Update Portfolio Category', 'adveditor' ),
			'add_new_item'      => __( 'Add New Portfolio Category', 'adveditor' ),
			'new_item_name'     => __( 'New Portfolio Category Name', 'adveditor' ),
			'menu_name'         => __( 'Portfolio Categories', 'adveditor' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'portfolio_cat' ),
		);
	  register_taxonomy( 'portfolio_cat', 'folio', $args );
	  
	  add_filter('manage_folio_posts_columns', array($this,'add_portfolio_columns'));
	  add_action('manage_folio_posts_custom_column', array($this,'manage_folio_columns_content'), 10, 2);
	  add_post_type_support( 'folio', 'thumbnail' );
	  add_action('add_meta_boxes', array($this,'add_video_custom_metaboxes'));
	  endif;
	  
	  if(!post_type_exists('video-posts')):
	  register_post_type( 'video-posts',
		array(
		  'labels' => array(
				'name' => __( 'Vídeos' ),
				'singular_name' => __( 'Vídeo' ),
				'all_items'           => __( 'All Items', 'adveditor' ),
				'view_item'           => __( 'View Item', 'adveditor' ),
				'add_new_item'        => __( 'Add New Item', 'adveditor' ),
				'add_new'             => __( 'Add New', 'adveditor' ),
				'edit_item'           => __( 'Edit Video', 'adveditor' ),
				'update_item'         => __( 'Update Video', 'adveditor' ),
				'not_found'           => __( 'No items', 'adveditor' ),
				'not_found_in_trash'  => __( 'No items', 'adveditor' ),
		   ),
		  'public' => true,
		  'hierarchical' => true,
		  'menu_icon' => 'dashicons-video-alt3',
		  'has_archive' => true,
		  'rewrite' => array('slug' => 'video-posts'),
		  /*'register_meta_box_cb' => 'add_events_metaboxes',*/
		  'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments')
		)
	  );
	  $labels = array(
			'name'              => _x( 'Video Categories', 'taxonomy general name', 'adveditor' ),
			'singular_name'     => _x( 'Video Category', 'taxonomy singular name', 'adveditor' ),
			'search_items'      => __( 'Search Video Categories', 'adveditor' ),
			'all_items'         => __( 'All Video Categories', 'adveditor' ),
			'parent_item'       => __( 'Parent Video Category', 'adveditor' ),
			'parent_item_colon' => __( 'Parent Video Category:', 'adveditor' ),
			'edit_item'         => __( 'Edit Video Category', 'adveditor' ),
			'update_item'       => __( 'Update Video Category', 'adveditor' ),
			'add_new_item'      => __( 'Add New Video Category', 'adveditor' ),
			'new_item_name'     => __( 'New Video Category Name', 'adveditor' ),
			'menu_name'         => __( 'Video Categories', 'adveditor' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'video_cat' ),
		);
	  register_taxonomy( 'video_cat', 'video-posts', $args );
	  add_action( 'edit_form_after_title', array($this,'edit_form_after_title') );
	  add_action( 'save_post', array($this,'wpt_save_related_posts_meta', 1, 2 ) );
	  endif;
	  
	  if(!post_type_exists('testimonials')):
	  register_post_type( 'testimonials',
		array(
		  'labels' => array(
			'name' => __( 'Testimonials' ),
			'singular_name' => __( 'Testimonials' )
		  ),
		  'public' => true,
		  'menu_icon' => 'dashicons-admin-comments',
		  'has_archive' => true,
		  'rewrite' => array('slug' => 'testimonial-posts')
		)
	  );
	  endif;
	}
	public function add_video_custom_metaboxes() {
		add_meta_box(
			'wp_video_url',
			'Vídeo URL',
			'wp_video_url',
			'video-posts',
			'after_title',
			'high'
		);
	}
	public function wp_video_url() {
		global $wpdb,$post_id;
		if(get_post_type($post_id)!=='video-posts')return ;
		wp_nonce_field( basename( __FILE__ ), 'video_fields' );
		$wp_video_url = get_post_meta( $post_id, 'wp_video_url', true );
	 
		echo '<input type="text" name="wp_video_url" id="wp_video_url" class="widefat" value="'.$wp_video_url.'">';
	}
	public function edit_form_after_title() {
		// get globals vars
		global $post, $wp_meta_boxes;
		if(get_post_type($post)!=='video-posts')return ;
		do_meta_boxes( get_current_screen(), 'after_title', $post );

		// unset 'ai_after_title' context from the post's meta boxes
		unset( $wp_meta_boxes['video-posts']['after_title'] );
	}
	public function wpt_save_related_posts_meta( $post_id, $post ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
		
		if ( ! wp_verify_nonce( $_POST['video_fields'], basename(__FILE__) ) ) {
			return $post_id;
		}
		
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}
		
		$wp_video_url = ( $_POST['wp_video_url'] );
		
		update_post_meta( $post_id, 'wp_video_url', $wp_video_url );
		if( ! $wp_video_url||empty($wp_video_url) ) {
			delete_post_meta( $post_id, 'wp_video_url' );
		}
	}

  }
  $HipercriativoPostTypes=new HipercriativoPostTypes();
}
/*
add_action( 'add_meta_boxes', 'add_folio_custom_metaboxes' );
function add_folio_custom_metaboxes() {
	add_meta_box(
		'wpt_related_posts',
		'Related Products',
		'wpt_related_posts',
		'folio',
		'side',
		'default'
	);
}
function wpt_related_posts() {
	global $wpdb,$woocommerce,$post_id;
	wp_nonce_field( basename( __FILE__ ), 'folio_fields' );
	$wpt_related_posts = get_post_meta( $post_id, 'wpt_related_posts', false );
 
    $args = array( 
        'post_type' => 'product',
        'post_status' => 'publish'
    );
    $products=$wpdb->get_results("SELECT ID,post_title FROM {$wpdb->prefix}posts WHERE post_type='product' AND post_status='publish'");
    if($products):
            echo '<div class="wpt_related_posts">';
            foreach ( $products as $product ):
            echo '<label';
            echo (in_array($product->ID,$wpt_related_posts[0]))?' style="color:#000;font-weight:bold"':'';
            echo '><input name="wpt_related_posts[]" class="widefat" type="checkbox" value="'.$product->ID.'"';
            echo (in_array($product->ID,$wpt_related_posts[0]))?'checked="checked"':'';
            echo '>'.$product->post_title.'</label><br>';
            endforeach;
            echo '</div>';
    endif;
    wp_reset_query();
}
add_action( 'admin_enqueue_scripts', 'add_admin_wpt_related_scripts', 10, 1 );
function add_admin_wpt_related_scripts()
{
    wp_enqueue_script( 'wpt_related_posts_js', get_template_directory_uri() . '/assets/js/wpt_related_posts.js' );
}
function wpt_save_related_posts_meta( $post_id, $post ) {
	// Return if the user doesn't have edit permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}
    
	if ( ! wp_verify_nonce( $_POST['folio_fields'], basename(__FILE__) ) ) {
		return $post_id;
	}
    
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    
	$rel_prod = ( $_POST['wpt_related_posts'] );
	// Cycle through the $events_meta array.
	// Note, in this example we just have one item, but this is helpful if you have multiple.
    //implode(',',$rel_prod)
	update_post_meta( $post_id, 'wpt_related_posts', $rel_prod );
	if( ! $rel_prod||empty($rel_prod)||count($rel_prod)==0 ) {
		// Delete the meta key if there's no value
		delete_post_meta( $post_id, 'wpt_related_posts' );
	}
}
add_action( 'save_post', 'wpt_save_related_posts_meta', 1, 2 );

*/