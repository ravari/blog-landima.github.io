<?php
add_shortcode('latest_post', 'theme_last_post_shortcode');

function theme_last_post_shortcode($atts)
{
    $cats = get_the_category();
    $atts = shortcode_atts(array(
        'cat'=>$cats[0]->term_id,
        'more_cap'=>'ادامه مطلب'
    ), $atts, 'latest_post');
    $last = wp_get_recent_posts(array(
        'numberposts' => 1,
        'category' => $atts['cat'],
        'orderby' => 'post_date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish'
    ))[0];
    ob_start();
    include "shortcodes/last_post.php";
    return ob_get_clean();
}
function enqueue_plugin_scripts($plugin_array)
{
    $plugin_array["latest_post"] = THEME_DIR."/js/tinymce/theme.plugins.js";
    return $plugin_array;
}
add_filter("mce_external_plugins", "enqueue_plugin_scripts");
function register_buttons_editor($buttons)
{
    array_push($buttons, "latest_post");
    array_push($buttons, "reg_form");
    return $buttons;
}
add_filter("mce_buttons", "register_buttons_editor");

add_action('wp_ajax_shortcode_latest_post_form', 'theme_shortcode_latest_post_form');
add_action('wp_ajax_nopriv_shortcode_latest_post_form', 'theme_shortcode_latest_post_form');

function theme_shortcode_latest_post_form()
{
    include 'shortcodes/last_post_form.php';
    wp_die();
}
