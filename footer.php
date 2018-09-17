<?php
/**

 * The template for displaying the footer

 * Contains the closing of the #content div and all content after.

 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials

 * @package WordPress

 * @subpackage Eléctrico

 * @since 1.0

 * @version 1.0

 */
?>
</main><!--end .main-content-->
<div class="clearfix"></div>
<footer class="global-footer">
    <div class="container-fluid">
      <div class="row footer-bottom ">
          <?php if(is_active_sidebar('footer-1')):
            echo '<div class="col footer-col ">';
            dynamic_sidebar('footer-1');
            echo '</div>';
          endif; ?>
          <?php if(is_active_sidebar('footer-2')):
            echo '<div class="col footer-col">';
            dynamic_sidebar('footer-2');
            echo '</div>';
          endif; ?>
          <?php if(is_active_sidebar('footer-3')):
            echo '<div class="col footer-col">';
            dynamic_sidebar('footer-3');
            echo '</div>';
          endif; ?>
          <?php if(is_active_sidebar('footer-4')):
            echo '<div class="col footer-col">';
            dynamic_sidebar('footer-4');
            echo '</div>';
          endif; ?>
          <?php if(is_active_sidebar('footer-5')):
            echo '<div class="col footer-col">';
            dynamic_sidebar('footer-5');
            echo '</div>';
          endif; ?>
		  <?php if(is_active_sidebar('footer-6')):
            echo '<div class="col footer-col">';
            dynamic_sidebar('footer-6');
            echo '</div>';
          endif; ?>
      </div>
    </div>
    
    <?php if(is_active_sidebar('sub_footer')):
    echo '<div class="footer-end text-center"><div class="col-xs-12 footer-col">';
    dynamic_sidebar('sub_footer');
    echo '</div></div>';
    endif; ?>
  </footer>
<?php wp_footer(); ?>
</body>
</html>