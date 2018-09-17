<?php defined( 'ABSPATH' ) OR exit; ?>
<form method="post" enctype="multipart/form-data">
<div class="col-lg-6">
	<div class="form-group">
        <label for="header_toolbar_background_color">Header Toolbar Background Color</label>
          <div class="input-group" id="header_toolbar_background_color">
            <input type="name" name="electrico_theme_options_styles[header_toolbar_background_color]" class="form-control colorpicker" value="<?php echo $header_toolbar_background_color;?>" placeholder="#FFFFFF">
            <span class="input-group-addon"><i></i></span>
          </div>
    </div>
	<div class="form-group">
        <label for="header_toolbar_link_color">Header Toolbar Link Color</label>
          <div class="input-group" id="header_toolbar_link_color">
            <input type="name" name="electrico_theme_options_styles[header_toolbar_link_color]" class="form-control colorpicker" value="<?php echo $header_toolbar_link_color;?>" placeholder="#CCCCCC">
            <span class="input-group-addon"><i></i></span>
          </div>
        </div>
        <div class="form-group">
        <label for="header_toolbar_hover_link_color">Header Toolbar Hover Link Color</label>
          <div class="input-group" id="header_toolbar_hover_link_color">
            <input type="name" name="electrico_theme_options_styles[header_toolbar_hover_link_color]" class="form-control colorpicker" value="<?php echo $header_toolbar_hover_link_color;?>" placeholder="#CCCCCC">
            <span class="input-group-addon"><i></i></span>
          </div>
        </div>
</div>

<div class="col-lg-6">
	<div class="form-group">
        <label for="header_background_color">Header Background Color</label>
          <div class="input-group" id="header_background_color">
            <input type="name" name="electrico_theme_options_styles[header_background_color]" class="form-control colorpicker" value="<?php echo $header_background_color;?>" placeholder="#FFFFFF">
            <span class="input-group-addon"><i></i></span>
          </div>
    </div>
        <div class="form-group">
        <label for="header_link_color">Header Link Color</label>
          <div class="input-group" id="header_link_color">
            <input type="name" name="electrico_theme_options_styles[header_link_color]" class="form-control colorpicker" value="<?php echo $header_link_color;?>" placeholder="#CCCCCC">
            <span class="input-group-addon"><i></i></span>
          </div>
        </div>
        <div class="form-group">
        <label for="header_hover_link_color">Header Hover Link Color</label>
          <div class="input-group" id="header_hover_link_color">
            <input type="name" name="electrico_theme_options_styles[header_hover_link_color]" class="form-control colorpicker" value="<?php echo $header_hover_link_color;?>" placeholder="#CCCCCC">
            <span class="input-group-addon"><i></i></span>
          </div>
        </div>
</div>

<hr class="w-100 clearfix" />

<div class="col-lg-6">
        <div class="form-group">
        <label for="body_background">Body Background</label>
          <div class="input-group" id="body_background">
            <input type="name" name="electrico_theme_options_styles[body_background]" class="form-control colorpicker" value="<?php echo $body_background;?>" placeholder="#CCCCCC">
            <div class="input-group-addon"><i></i></div>
          </div>
        </div>
        <div class="form-group">
        <label for="body_text">Body Text</label>
          <div class="input-group" id="body_text">
            <input type="name" name="electrico_theme_options_styles[body_text]" class="form-control colorpicker" value="<?php echo $body_text;?>" placeholder="#CCCCCC">
            <div class="input-group-addon"><i></i></div>
          </div>
        </div>
</div>
<div class="col-lg-6">
        <div class="form-group">
        <label for="link_color">Body Link Color</label>
          <div class="input-group" id="link_color">
            <input type="name" name="electrico_theme_options_styles[link_color]" class="form-control colorpicker" value="<?php echo $link_color;?>" placeholder="#CCCCCC">
            <span class="input-group-addon"><i></i></span>
          </div>
        </div>
        <div class="form-group">
        <label for="hover_link_color">Body Hover Link Color</label>
          <div class="input-group" id="hover_link_color">
            <input type="name" name="electrico_theme_options_styles[hover_link_color]" class="form-control colorpicker" value="<?php echo $hover_link_color;?>" placeholder="#CCCCCC">
            <span class="input-group-addon"><i></i></span>
          </div>
        </div>
</div>
<hr class="w-100 clearfix" />

<div class="col-lg-6">
	<div class="form-group">
        <label for="footer_background_color">Footer Background Color</label>
          <div class="input-group" id="footer_background_color">
            <input type="name" name="electrico_theme_options_styles[footer_background_color]" class="form-control colorpicker" value="<?php echo $footer_background_color;?>" placeholder="#FFFFFF">
            <span class="input-group-addon"><i></i></span>
          </div>
    </div>
	<div class="form-group">
        <label for="footer_text_color">Footer Text Color</label>
          <div class="input-group" id="footer_text_color">
            <input type="name" name="electrico_theme_options_styles[footer_text_color]" class="form-control colorpicker" value="<?php echo $footer_text_color;?>" placeholder="#FFFFFF">
            <span class="input-group-addon"><i></i></span>
          </div>
    </div>
	<div class="form-group">
        <label for="footer_link_color">Footer Link Color</label>
          <div class="input-group" id="footer_link_color">
            <input type="name" name="electrico_theme_options_styles[footer_link_color]" class="form-control colorpicker" value="<?php echo $footer_link_color;?>" placeholder="#FFFFFF">
            <span class="input-group-addon"><i></i></span>
          </div>
    </div>
</div>

<hr class="w-100 clearfix" />
<div class="col-lg-12 text-right">
<?php wp_nonce_field( -1,'wphipercriativo_themeoptions_styles' ); ?>
<input type="submit" value="Save" class="btn btn-success" />
</div>
		
</form>