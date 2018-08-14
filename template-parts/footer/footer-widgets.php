<?php
/**
 * Displays footer widgets if assigned
 *
 * @package WordPress
 * @subpackage Eléctrico
 * @since 1.0
 * @version 1.0
 */

?>

<?php
if ( is_active_sidebar( 'sidebar-2' ) ||
	 is_active_sidebar( 'sidebar-3' ) ) :
?>

	
	<?php
	if ( is_active_sidebar( 'sidebar-2' ) ) { 
          ?>
          <aside class="widget-area col-md-12" role="complementary">
			<div class="widget-column footer-widget-1">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</div>
          </aside><!-- .widget-area -->
	<?php } ?>
	
    <?php 
	if ( is_active_sidebar( 'sidebar-3' ) ) { ?>
        <aside class="widget-area col-md-3" role="complementary">
    		
    			<div class="widget-column footer-widget-2">
    				<?php dynamic_sidebar( 'sidebar-3' ); ?>
    			</div>
    		
    	</aside><!-- .widget-area -->
    <?php } ?>
    
    <?php 
	if ( is_active_sidebar( 'sidebar-4' ) ) { ?>
        <aside class="widget-area col-md-3" role="complementary">
    		
    			<div class="widget-column footer-widget-3">
    				<?php dynamic_sidebar( 'sidebar-4' ); ?>
    			</div>
    		
    	</aside><!-- .widget-area -->
    <?php } ?>
    
    <?php 
	if ( is_active_sidebar( 'sidebar-5' ) ) { ?>
        <aside class="widget-area col-md-3" role="complementary">
    		
    			<div class="widget-column footer-widget-4">
    				<?php dynamic_sidebar( 'sidebar-5' ); ?>
    			</div>
    		
    	</aside><!-- .widget-area -->
    <?php } ?>
<?php endif; ?>
