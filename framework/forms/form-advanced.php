<?php defined( 'ABSPATH' ) OR exit; ?>
<div class="col-lg-12">
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
        <label for="advanced_css">Custom CSS</label>
          
            <textarea name="electrico_advanced_css" class="form-control" placeholder="Custom CSS"><?php echo ($advanced_css)?wp_unslash($advanced_css):'';?></textarea>
          
        </div>
        <div class="form-group">
        <label for="advanced_js">Custom jQuery</label>
          
            <textarea name="electrico_advanced_js" class="form-control" placeholder="Custom jQuery"><?php echo ($advanced_js)?wp_unslash($advanced_js):'';?></textarea>
         
        </div>
        <?php wp_nonce_field( -1,'wphipercriativo_themeoptions_action_advanced' ); ?>
        <input type="submit" value="Save" class="btn btn-success" />
    </form>
</div>