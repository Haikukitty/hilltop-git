<?php

/*
  Plugin Name: Google Recaptcha for Divi Forms
  Plugin URI: https://trumani.com/divi-google-captcha
  Description: Adding Google Recaptcha functionality to Divi forms
  Version: 1.0
  Author: Trumani
  Author URI: https://trumani.com
  License: GPLv2+
*/

add_filter( 'wp_footer', 'talla_captcha_form',15,2 );
add_filter( 'wp_footer', 'google_captcha_js_code',15,2 );
function talla_captcha_form( $content ) {

//get current post
global $post;
global $wp_filter;

//echo '<div class="col-md-12"><div class="g-recaptcha" data-sitekey= "'.$key.'"></div></div>';
?>
<script type="text/javascript">
	var key = "<?php echo get_option( 'secret_key' );?>";
jQuery( '.et_contact_bottom_container' ).prepend( '<div class="col-md-12"><div class="g-recaptcha" data-sitekey= "'+key+'"></div></div>' );
</script>
<?php 

}

// create custom plugin settings menu
add_action('admin_menu', 'talla_create_menu');

function talla_create_menu() {

  add_submenu_page('options-general.php','Divi Google Recaptcha Settings', 'Divi Google Recaptcha', 'administrator', __FILE__, 'talla_setting_page');
	add_action( 'admin_init', 'talla_plugin_settings' );
}


function talla_plugin_settings() {
	register_setting( 'talla_form_field_list', 'secret_key' );
	register_setting( 'talla_form_field_list', 'site_id' );
}

function talla_setting_page() {
?>
<div class="wrap">
<h1>Google Recaptcha Details</h1>
<p>Enter <a href="https://www.google.com/recaptcha" target="_blank">Google No CAPTCHA reCAPTCHA</a> key settings below:</p>
<form method="post" action="options.php">
    <?php settings_fields( 'talla_form_field_list' ); ?>
    <?php do_settings_sections( 'talla_form_field_list' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Site key</th>
        <td><input type="text" name="secret_key" value="<?php echo esc_attr( get_option('secret_key') ); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Secret key</th>
        <td><input type="text" name="site_id" value="<?php echo esc_attr( get_option('site_id') ); ?>" /></td>
        </tr>

    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php } ?>
<?php 

function google_captcha_js_code(){
?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">
jQuery(".et_pb_contact_submit").click(function(e){

        var data_2;
    jQuery.ajax({
                type: "POST",
                url: "<?php echo get_site_url();?>/wp-content/plugins/talla/google_captcha.php",
                data: jQuery('.et_pb_contact_form').serialize(),

                async:false,
                success: function(data) {
                console.log(data);

                 if(data.nocaptcha==="true") {
               data_2=1;
                  } else if(data.spam==="true") {
               data_2=1;
                  } else {
               data_2=0;
                  }
                }
            });

            if(data_2!=0) {
              e.preventDefault();
              if(data_2==1) {
                alert("Please check the captcha");
              } else {
               jQuery(".et_pb_contact_form").submit();
              }
            } else {
                jQuery(".et_pb_contact_form").submit();
           }
  });
</script>
<?php

}