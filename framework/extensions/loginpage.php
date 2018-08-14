<?php
function adf_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
        background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png);
		width:220px;
        height:160px;
        background-size:100%;
		background-repeat: no-repeat;
        padding-bottom: 2px;
        outline:0;
        border:0;
        text-decoration:none;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'adf_login_logo' );
function adf_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'adf_login_logo_url' );

function adf_login_logo_url_title() {
    $title_site=get_bloginfo('name');
    if(!$title_site)$title_site='ADF';
    return $title_site;
}
add_filter( 'login_headertitle', 'adf_login_logo_url_title' );