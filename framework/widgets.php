<?php
class WP_Social_Widget extends WP_Widget
{
    public function __construct() {
        $widget_ops = array( 
			'classname' => 'wp_social_widget',
			'description' => 'Social Widget',
		);
		parent::__construct( 'wp_social_widget', 'Social Widget', $widget_ops );
        
    }
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];
        
        if((!empty($instance[ 'wp_widget_facebook' ]))):
            echo '<div class="social-link">';
            echo '<a href="'.html_entity_decode($instance[ 'wp_widget_facebook' ]).'" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a>';
            echo '</div>';
        endif;
        if((!empty($instance[ 'wp_widget_youtube' ]))):
            echo '<div class="social-link">';
            echo '<a href="'.html_entity_decode($instance[ 'wp_widget_youtube' ]).'" target="_blank" title="Youtube"><i class="fa fa-youtube-play"></i></a>';
            echo '</div>';
        endif;
        if((!empty($instance[ 'wp_widget_instagram' ]))):
            echo '<div class="social-link">';
            echo '<a href="'.html_entity_decode($instance[ 'wp_widget_instagram' ]).'" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a>';
            echo '</div>';
        endif;
        if((!empty($instance[ 'wp_widget_twitter' ]))):
            echo '<div class="social-link">';
            echo '<a href="'.html_entity_decode($instance[ 'wp_widget_twitter' ]).'" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a>';
            echo '</div>';
        endif;
		if((!empty($instance[ 'wp_widget_linkedin' ]))):
            echo '<div class="social-link">';
            echo '<a href="'.html_entity_decode($instance[ 'wp_widget_linkedin' ]).'" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a>';
            echo '</div>';
        endif;
        if((!empty($instance[ 'wp_widget_pinterest' ]))):
            echo '<div class="social-link">';
            echo '<a href="'.html_entity_decode($instance[ 'wp_widget_pinterest' ]).'" target="_blank" title="Pinterest"><i class="fa fa-pinterest"></i></a>';
            echo '</div>';
        endif;
        
        echo $args['after_widget'];
    }
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
        $title = $instance[ 'title' ];
        $wp_widget_facebook = $instance[ 'wp_widget_facebook' ];
        $wp_widget_youtube = $instance[ 'wp_widget_youtube' ];
        $wp_widget_instagram = $instance[ 'wp_widget_instagram' ];
        $wp_widget_twitter = $instance[ 'wp_widget_twitter' ];
        $wp_widget_pinterest = $instance[ 'wp_widget_pinterest' ];
        $wp_widget_linkedin = $instance[ 'wp_widget_linkedin' ];
        }
        else {
        $title = $wp_widget_facebook = $wp_widget_youtube = $wp_widget_instagram = $wp_widget_twitter = $wp_widget_pinterest = $wp_widget_linkedin = '';
        }
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        
        <p>
        <label for="<?php echo $this->get_field_id( 'wp_widget_facebook' ); ?>">Facebook URL</label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'wp_widget_facebook' ); ?>" name="<?php echo $this->get_field_name( 'wp_widget_facebook' ); ?>" type="text" value="<?php echo html_entity_decode( $wp_widget_facebook ); ?>" />
        </p>
        
        <p>
        <label for="<?php echo $this->get_field_id( 'wp_widget_youtube' ); ?>">Youtube URL</label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'wp_widget_youtube' ); ?>" name="<?php echo $this->get_field_name( 'wp_widget_youtube' ); ?>" type="text" value="<?php echo html_entity_decode( $wp_widget_youtube ); ?>" />
        </p>
        
        <p>
        <label for="<?php echo $this->get_field_id( 'wp_widget_instagram' ); ?>">Instagram URL</label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'wp_widget_instagram' ); ?>" name="<?php echo $this->get_field_name( 'wp_widget_instagram' ); ?>" type="text" value="<?php echo html_entity_decode( $wp_widget_instagram ); ?>" />
        </p>
		
		<p>
        <label for="<?php echo $this->get_field_id( 'wp_widget_linkedin' ); ?>">Linkedin URL</label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'wp_widget_linkedin' ); ?>" name="<?php echo $this->get_field_name( 'wp_widget_linkedin' ); ?>" type="text" value="<?php echo html_entity_decode( $wp_widget_linkedin ); ?>" />
        </p>
        
        <p>
        <label for="<?php echo $this->get_field_id( 'wp_widget_twitter' ); ?>">Twitter URL</label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'wp_widget_twitter' ); ?>" name="<?php echo $this->get_field_name( 'wp_widget_twitter' ); ?>" type="text" value="<?php echo html_entity_decode( $wp_widget_twitter ); ?>" />
        </p>
        
        <p>
        <label for="<?php echo $this->get_field_id( 'wp_widget_pinterest' ); ?>">Pinterest URL</label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'wp_widget_pinterest' ); ?>" name="<?php echo $this->get_field_name( 'wp_widget_pinterest' ); ?>" type="text" value="<?php echo html_entity_decode( $wp_widget_pinterest ); ?>" />
        </p>
        <?php 
    }
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['wp_widget_facebook'] = ( ! empty($new_instance[ 'wp_widget_facebook' ]) ) ? htmlentities( $new_instance['wp_widget_facebook'] ) : '';
        $instance['wp_widget_youtube'] = ( ! empty($new_instance[ 'wp_widget_youtube' ]) ) ? htmlentities( $new_instance['wp_widget_youtube'] ) : '';
        $instance['wp_widget_instagram'] = ( ! empty($new_instance[ 'wp_widget_instagram' ]) ) ? htmlentities( $new_instance['wp_widget_instagram'] ) : '';
        $instance['wp_widget_twitter'] = ( ! empty($new_instance[ 'wp_widget_twitter' ]) ) ? htmlentities( $new_instance['wp_widget_twitter'] ) : '';
        $instance['wp_widget_pinterest'] = ( ! empty($new_instance[ 'wp_widget_pinterest' ]) ) ? htmlentities( $new_instance['wp_widget_pinterest'] ) : '';
        $instance['wp_widget_linkedin'] = ( ! empty($new_instance[ 'wp_widget_linkedin' ]) ) ? htmlentities( $new_instance['wp_widget_linkedin'] ) : '';
        return $instance;
    }
}
add_action( 'widgets_init', function(){
	register_widget( 'WP_Social_Widget' );
});
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function eletrico_sidebar_init() {
    register_sidebar( array(
		'name'          => __( 'Header 1', 'eletrico' ),
		'id'            => 'header-1',
		'description'   => __( 'Add widgets here to appear on your header.', 'eletrico' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    register_sidebar( array(
		'name'          => __( 'Header 2', 'eletrico' ),
		'id'            => 'header-2',
		'description'   => __( 'Add widgets here to appear on your header.', 'eletrico' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'eletrico' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'eletrico' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'eletrico' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your sidebar on pages posts.', 'eletrico' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'eletrico' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'eletrico' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'eletrico' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'eletrico' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => __( 'Footer 3', 'eletrico' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'eletrico' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => __( 'Footer 4', 'eletrico' ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'eletrico' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => __( 'Footer 5', 'eletrico' ),
		'id'            => 'footer-5',
		'description'   => __( 'Add widgets here to appear in your footer.', 'eletrico' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 6', 'eletrico' ),
		'id'            => 'footer-6',
		'description'   => __( 'Add widgets here to appear in your footer.', 'eletrico' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => __( 'Sub Footer', 'eletrico' ),
		'id'            => 'sub_footer',
		'description'   => __( 'Add widgets here to appear in your sub-footer.', 'eletrico' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'eletrico_sidebar_init' );