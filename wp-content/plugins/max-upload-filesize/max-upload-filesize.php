<?php
/**
 * Plugin Name: Max upload filesize
 * Description: Set upload filesize limit
 * Version:     1.1.0
 * Author:      Yinlong
 * Author URI:  https://www.linkedin.com/in/yinlong-shao-559605189/
 * Donate link: https://www.paypal.me/shaoyinlong
 * License:     GPL2
 */

register_activation_hook(__FILE__, 'yld_set_upload_filesize_activation');
function yld_set_upload_filesize_activation(){
   //$yld_max_upload_filesize = wp_max_upload_size();
   $u_bytes = wp_convert_hr_to_bytes( ini_get( 'upload_max_filesize' ) );
   $p_bytes = wp_convert_hr_to_bytes( ini_get( 'post_max_size' ) );
   update_option('yld_max_upload_filesize', min( $u_bytes, $p_bytes ));
}

register_uninstall_hook(__FILE__, 'yld_set_upload_filesize_uninstall');
function yld_set_upload_filesize_uninstall(){
    delete_option('yld_max_upload_filesize'); 
}


add_filter('upload_size_limit', 'yld_set_upload_filesize');
function yld_set_upload_filesize(){
    return get_option('yld_max_upload_filesize');
}


add_action('admin_menu', 'yld_create_upload_setting_form');
function yld_create_upload_setting_form(){
    add_menu_page('YLD set upload filesize', 'Upload Filesize', 'manage_options', 'yld-upload-setting-menu', 'yld_upload_setting'); 
}


function yld_upload_setting() {
    if (sanitize_text_field($_POST['submit']) && check_admin_referer('yld_test')) {
		$yld_max_upload_filesize = sanitize_text_field($_POST['max_upload_filesize']);
        if(!is_numeric($yld_max_upload_filesize) || $yld_max_upload_filesize<0) {
            $m = 'Max Upload Filesize must be a positive number!! ';
        } else {
            update_option('yld_max_upload_filesize', $yld_max_upload_filesize*1024*1024);
            $m = true;
        }     
    }
    
    $yld_max_upload_filesize = get_option('yld_max_upload_filesize'); 
    include 'input.template.php';
}