<?php
add_action('add_meta_boxes', 'theme_register_meta_boxes');
add_action('save_post', 'theme_save_meta_box');

function theme_register_meta_boxes()
{
    add_meta_box('landstars_meta', 'لنداستارز', 'landstars_metabox', 'page', 'side');
}
 
function landstars_metabox($post)
{
    include 'landstars.php';
}

function theme_save_meta_box($post_id)
{
    if (isset($_POST['_themenonce']) && get_current_screen()->id == "page" && check_admin_referer('save_landstars_meta', '_themenonce')) {
        update_post_meta($post_id, 'lns_date', sanitize_text_field($_REQUEST['lns_date']));
        update_post_meta($post_id, 'lns_time', sanitize_text_field($_REQUEST['lns_time']));
        update_post_meta($post_id, 'lns_location', sanitize_text_field($_REQUEST['lns_location']));
        update_post_meta($post_id, 'lns_capacity', sanitize_text_field($_REQUEST['lns_capacity']));
    }
}
