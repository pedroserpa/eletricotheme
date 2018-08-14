<?php defined( 'ABSPATH' ) OR exit;?>
<form method="post" enctype="multipart/form-data">
<div class="col-lg-6">
        <div class="form-group">
        <label for="footer_style">Footer Style</label>
          <div class="input-group" id="footer_style">
            <select name="electrico_theme_options_settings[footer_style]" class="form-control select2">
              <option value="footer_1_col" <?php echo ($footer_style=='footer_1_col')?'selected':'';?>><?php echo __('One column','electrico');?></option>  
              <option value="footer_2_col" <?php echo ($footer_style=='footer_2_col')?'selected':'';?>><?php echo __('Two columns','electrico');?></option> 
              <option value="footer_3_col" <?php echo ($footer_style=='footer_3_col')?'selected':'';?>><?php echo __('Three columns','electrico');?></option>
              <option value="footer_4_col" <?php echo ($footer_style=='footer_4_col')?'selected':'';?>><?php echo __('Four columns','electrico');?></option> 
              <option value="footer_5_col" <?php echo ($footer_style=='footer_5_col')?'selected':'';?>><?php echo __('Five columns','electrico');?></option>  
            </select>
          </div>
        </div>
</div>
<div class="col-lg-6">
        <?php wp_nonce_field( -1,'wphipercriativo_themeoptions_footer_styles' ); ?>
        <input type="submit" value="Save" class="btn btn-success" />
</div>
</form>