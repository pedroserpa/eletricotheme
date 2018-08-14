<?php defined( 'ABSPATH' ) OR exit;?>
<form method="post" enctype="multipart/form-data">
<div class="col-lg-6">
        <div class="form-group">
        <label for="header_style">Header Style</label>
          <div class="input-group" id="header_style">
            <select name="electrico_theme_options_header_styles[header_style]" class="form-control select2">
              <option value="logo_on_left" <?php echo ($header_style=='logo_on_left')?'selected':'';?>><?php echo __('Logo on left / Menu on the right','electrico');?></option>  
              <option value="logo_on_top" <?php echo ($header_style=='logo_on_top')?'selected':'';?>><?php echo __('Logo on top / Menu on bottom','electrico');?></option>  
            </select>
          </div>
        </div>
		<div class="form-group">
            <div class="checkbox checkbox-inline">
            <input type="checkbox" name="electrico_theme_options_header_styles[full_width_header_style]" <?php echo ($full_width_header_style&&$full_width_header_style=='1')?'checked':'';?> value="<?php echo ($full_width_header_style)?'1':'0';?>">
            <label for="full_width_header_style" style="padding-left: 5px;">Full Width Header?</label>
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox checkbox-inline">
            <input type="checkbox" name="electrico_theme_options_header_styles[social_menu]" <?php echo ($social_menu&&$social_menu=='1')?'checked':'';?> value="<?php echo ($social_menu)?'1':'0';?>">
            <label for="social_menu" style="padding-left: 5px;">Social Menu?</label>
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox checkbox-inline">
            <input type="checkbox" name="electrico_theme_options_header_styles[show_toolbar]" <?php echo ($show_toolbar&&$show_toolbar=='1')?'checked':'';?> value="<?php echo ($show_toolbar)?'1':'0';?>">
            <label for="show_toolbar" style="padding-left: 5px;">Show Toolbar</label>
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox checkbox-inline">
            <input type="checkbox" name="electrico_theme_options_header_styles[fullscreen_nav]" <?php echo ($fullscreen_nav&&$fullscreen_nav=='1')?'checked':'';?> value="<?php echo ($fullscreen_nav)?'1':'0';?>">
            <label for="fullscreen_nav" style="padding-left: 5px;">Use Fullscreen Menu</label>
            </div>
        </div>
</div>
<div class="col-lg-6">
        <?php wp_nonce_field( -1,'wphipercriativo_themeoptions_header_styles' ); ?>
        <input type="submit" value="Save" class="btn btn-success" />
</div>
</form>