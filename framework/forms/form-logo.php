<?php defined( 'ABSPATH' ) OR exit; ?>
<div class="col-lg-6">
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
        <label for="header_logo">Header Logo</label>
          <div class="input-group" id="header_logo">
            <input type="name" name="electrico_theme_options_logos[header_logo]" class="form-control image-field" value="<?php echo $header_logo;?>" placeholder="">
            <div class="input-group-addon image-select"><i class="fa fa-image"></i></div>
          </div>
        </div>
        <div class="form-group">
        <label for="alt_logo">Alt Logo</label>
          <div class="input-group" id="alt_logo">
            <input type="name" name="electrico_theme_options_logos[alt_logo]" class="form-control image-field" value="<?php echo $alt_logo;?>" placeholder="">
            <div class="input-group-addon image-select"><i class="fa fa-image"></i></div>
          </div>
        </div>
        <div class="form-group">
        <label for="alt_logo">Shop Logo</label>
          <div class="input-group" id="alt_logo">
            <input type="name" name="electrico_theme_options_logos[shop_logo]" class="form-control image-field" value="<?php echo $shop_logo;?>" placeholder="">
            <div class="input-group-addon image-select"><i class="fa fa-image"></i></div>
          </div>
        </div>
        <div class="form-group">
        <label for="mobile_logo">Mobile Logo</label>
          <div class="input-group" id="mobile_logo">
            <input type="name" name="electrico_theme_options_logos[mobile_logo]" class="form-control image-field" value="<?php echo $mobile_logo;?>" placeholder="">
            <span class="input-group-addon image-select"><i class="fa fa-image"></i></span>
          </div>
        </div>
        <div class="form-group">
        <label for="favicon_logo">Favicon</label>
          <div class="input-group" id="favicon_logo">
            <input type="name" name="electrico_theme_options_logos[favicon_logo]" class="form-control image-field" value="<?php echo $favicon_logo;?>" placeholder="">
            <span class="input-group-addon image-select"><i class="fa fa-image"></i></span>
          </div>
        </div>
        <?php wp_nonce_field( -1,'wphipercriativo_themeoptions_logos' ); ?>
        <input type="submit" value="Save" class="btn btn-success" />
    </form>
</div>
<div class="col-lg-6">
    <div id="image-preview"></div>
</div>