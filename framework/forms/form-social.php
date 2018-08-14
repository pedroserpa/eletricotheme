<?php defined( 'ABSPATH' ) OR exit; ?>
<form method="post" enctype="multipart/form-data">
    <div class="col-lg-6">
        <div class="form-group">
        <label for="facebook_link">Facebook</label>
          <div class="input-group" id="facebook_link">
            <div class="input-group-addon"><i class="fa fa-facebook"></i></div>
            <input type="name" name="electrico_theme_options_social_links[facebook_link]" class="form-control" value="<?php echo $facebook_link;?>" placeholder="Facebook">
          </div>
        </div>
        <div class="form-group">
        <label for="twitter_link">Twitter</label>
          <div class="input-group" id="twitter_link">
            <div class="input-group-addon"><i class="fa fa-twitter"></i></div>
            <input type="name" name="electrico_theme_options_social_links[twitter_link]" class="form-control" value="<?php echo $twitter_link;?>" placeholder="Twitter">
          </div>
        </div>
        <div class="form-group">
        <label for="instagram_link">Instagram</label>
          <div class="input-group" id="instagram_link">
            <div class="input-group-addon"><i class="fa fa-instagram"></i></div>
            <input type="name" name="electrico_theme_options_social_links[instagram_link]" class="form-control" value="<?php echo $instagram_link;?>" placeholder="Instagram">
          </div>
        </div>
        <div class="form-group">
        <label for="pinterest_link">Pinterest</label>
          <div class="input-group" id="pinterest_link">
            <div class="input-group-addon"><i class="fa fa-pinterest"></i></div>
            <input type="name" name="electrico_theme_options_social_links[pinterest_link]" class="form-control" value="<?php echo $pinterest_link;?>" placeholder="Pinterest">
          </div>
        </div>
        <div class="form-group">
          <label for="behance_link">Behance</label>
          <div class="input-group" id="behance_link">
            <div class="input-group-addon"><i class="fa fa-behance"></i></div>
            <input type="name" name="electrico_theme_options_social_links[behance_link]" class="form-control" value="<?php echo $behance_link;?>" placeholder="Behance">
          </div>
        </div>
        <div class="form-group">
          <label for="linkedin_link">Linkedin</label>
          <div class="input-group" id="linkedin_link">
            <div class="input-group-addon"><i class="fa fa-linkedin"></i></div>
            <input type="name" name="electrico_theme_options_social_links[linkedin_link]" class="form-control" value="<?php echo $linkedin_link;?>" placeholder="Linkedin">
          </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="form-group">
        <label for="googleplus_link">Google Plus</label>
          <div class="input-group" id="googleplus_link">
            <div class="input-group-addon"><i class="fa fa-google-plus"></i></div>
            <input type="name" name="electrico_theme_options_social_links[googleplus_link]" class="form-control" value="<?php echo $googleplus_link;?>" placeholder="Google Plus">
          </div>
        </div>
        <div class="form-group">
        <label for="youtube_link">Youtube</label>
          <div class="input-group" id="youtube_link">
            <div class="input-group-addon"><i class="fa fa-youtube"></i></div>
            <input type="name" name="electrico_theme_options_social_links[youtube_link]" class="form-control" value="<?php echo $youtube_link;?>" placeholder="Youtube">
          </div>
        </div>
        <div class="form-group">
        <label for="vimeo_link">Vimeo</label>
          <div class="input-group" id="vimeo_link">
            <div class="input-group-addon"><i class="fa fa-vimeo"></i></div>
            <input type="name" name="electrico_theme_options_social_links[vimeo_link]" class="form-control" value="<?php echo $vimeo_link;?>" placeholder="Vimeo">
          </div>
        </div>
        <div class="form-group">
        <label for="flickr_link">Flickr</label>
          <div class="input-group" id="flickr_link">
            <div class="input-group-addon"><i class="fa fa-flickr"></i></div>
            <input type="name" name="electrico_theme_options_social_links[flickr_link]" class="form-control" value="<?php echo $flickr_link;?>" placeholder="Flickr">
          </div>
        </div>
        <div class="form-group">
          <label for="xing_link">Xing</label>
          <div class="input-group" id="xing_link">
            <div class="input-group-addon"><i class="fa fa-xing"></i></div>
            <input type="name" name="electrico_theme_options_social_links[xing_link]" class="form-control" value="<?php echo $xing_link;?>" placeholder="Xing">
          </div>
        </div>
        <div class="form-group">
          <label for="dribbble_link">Dribbble</label>
          <div class="input-group" id="dribbble_link">
            <div class="input-group-addon"><i class="fa fa-dribbble"></i></div>
            <input type="name" name="electrico_theme_options_social_links[dribbble_link]" class="form-control" value="<?php echo $dribbble_link;?>" placeholder="Dribbble">
          </div>
        </div>
        <?php wp_nonce_field( -1,'wphipercriativo_themeoptions_social' ); ?>
        <input type="submit" value="Save" class="btn btn-success" />
    </div>
</form>