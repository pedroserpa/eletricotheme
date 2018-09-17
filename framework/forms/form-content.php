<?php defined( 'ABSPATH' ) OR exit;?>
<form method="post" enctype="multipart/form-data">
<div class="col-lg-6">
	<div class="row">
        <div class="col-lg-6">
			<div class="form-group">
				<label for="content_style">Text Size</label>
				<input type="number" name="electrico_theme_options_content_styles[font_size]" class="form-control" placeholder="14" value="<?php echo (($content_styles['font_size']!=='')?$content_styles['font_size']:'14');?>">
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				<label for="content_style">Line Height</label>
				<input type="number" name="electrico_theme_options_content_styles[line_height]" class="form-control" placeholder="18" value="<?php echo (($content_styles['line_height']!=='')?$content_styles['line_height']:'18');?>">
			</div>
		</div>
		<div class="clearfix w-100"></div>
		<div class="col-lg-6">
			<div class="form-group">
				<label for="content_style">Text Margin</label>
				<input type="number" name="electrico_theme_options_content_styles[margin_bottom]" class="form-control" placeholder="18" value="<?php echo (($content_styles['margin_bottom']!=='')?intval($content_styles['margin_bottom']):'18');?>">
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				<label for="content_style">Text Padding</label>
				<input type="number" name="electrico_theme_options_content_styles[padding_bottom]" class="form-control" placeholder="18" value="<?php echo (($content_styles['padding_bottom']!=='')?intval($content_styles['padding_bottom']):'18');?>">
			</div>
		</div>
	</div>

		<label for="content_style">Text Color</label>
		<div class="input-group" id="content_style_text_color">
            <input type="name" name="electrico_theme_options_content_styles[text_color]" class="form-control colorpicker" value="<?php echo $content_styles['text_color'];?>" placeholder="#CCCCCC">
            <span class="input-group-addon"><i></i></span>
        </div>

        <label for="content_style" class="mt-15">Link Color</label>
		<div class="input-group" id="content_style_link_color">
            <input type="name" name="electrico_theme_options_content_styles[link_color]" class="form-control colorpicker" value="<?php echo $content_styles['link_color'];?>" placeholder="#CCCCCC">
            <span class="input-group-addon"><i></i></span>
        </div>

</div>
<div class="col-lg-6">
		
		<div class="clearfix"></div>
        <?php wp_nonce_field( -1,'wphipercriativo_themeoptions_content_styles' ); ?>
        <input type="submit" value="Save" class="btn btn-success" />
</div>
</form>