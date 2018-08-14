<?php defined( 'ABSPATH' ) OR exit; ?>
<div class="col-lg-6">
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="lang_menu_custom">Google API ID</label>
          <div class="input-group" id="google_api_id">
            <input name="electrico_theme_options_settings[google_api_id]" class="form-control" value="<?php echo ($google_api_id)?$google_api_id:'';?>">
            <div class="input-group-addon"><i class="fa fa-google"></i></div>
          </div>
        </div>
        <div class="form-group">
          <label for="lang_menu_custom">Facebook APP ID</label>
          <div class="input-group" id="facebook_app_id">
            <input name="electrico_theme_options_settings[facebook_app_id]" class="form-control" value="<?php echo ($facebook_app_id)?$facebook_app_id:'';?>">
            <div class="input-group-addon"><i class="fa fa-facebook-square"></i></div>
          </div>
        </div>
        
        <?php
        if( function_exists('icl_object_id') ) {?>
        <div class="form-group">
        <label for="lang_menu_custom">Custom Language Menu</label>
          <div class="input-group" id="lang_menu_custom">
            <select name="electrico_theme_options_settings[lang_menu_custom]" class="form-control">
                <option value="false" <?php echo (!$lang_menu_custom||$lang_menu_custom&&$lang_menu_custom=='false')?'selected':'';?>>Off</option>
                <option value="true" <?php echo ($lang_menu_custom&&$lang_menu_custom=='true')?'selected':'';?>>On</option>
            </select>
            <div class="input-group-addon"><i class="fa fa-flag"></i></div>
          </div>
        </div>
        <?php } ?>
        <?php wp_nonce_field( -1,'wphipercriativo_themeoptions_settings' ); ?>
        <input type="submit" value="Save" class="btn btn-success" />
    </form>
</div>
<div class="col-lg-6">
    
</div>