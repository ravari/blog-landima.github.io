<?php
ob_start();
include 'metabox/init.php';

const REG_NAMES = [
    'freelancer'=>'فریلنسر',
    'team_master'=>'رهبر تیم',
    'team_member'=>'عضو تیم',
    'traveler'=>'مسافر',
];
const MEM_STATUS = [
    'in_progress' => 'در حال بررسی',
    'proved' => 'تایید شده',
    // 'ignored' => 'چشم پوشی شده',
    'inactive' => 'تعلیق شده'
];
const MEM_STATUS_COLOR = [
    'in_progress' => 'primary',
    'proved' => 'success',
    'ignored' => 'danger',
    'inactive' => 'warning'
];
add_action('admin_head','theme_admin_head');
add_action('admin_init','theme_admin_init');
add_action('admin_menu','theme_admin_menu');

add_action('admin_bar_menu','theme_admin_bar_menu');
add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);
add_action( 'wp_ajax_register_user', 'theme_register_user' );
add_action( 'wp_ajax_nopriv_register_user', 'theme_register_user' );
add_action( 'delete_user', 'theme_delete_user');
add_action('restrict_manage_users', 'theme_user_list_filtering');


add_action( 'wp_ajax_mobile_exists', 'theme_mobile_exists' );
add_action( 'wp_ajax_nopriv_mobile_exists', 'theme_mobile_exists');

add_action( 'wp_ajax_ncode_exists', 'theme_ncode_exists' );
add_action( 'wp_ajax_nopriv_ncode_exists', 'theme_ncode_exists');

add_action( 'wp_ajax_username_exists', 'theme_username_exists' );
add_action( 'wp_ajax_nopriv_username_exists', 'theme_username_exists');

add_action( 'wp_ajax_email_exists', 'theme_email_exists' );
add_action( 'wp_ajax_nopriv_email_exists', 'theme_email_exists');

add_action( 'wp_ajax_assign_user_form', 'assign_user_form' );
add_action( 'wp_ajax_nopriv_assign_user_form', 'assign_user_form');

add_action( 'wp_ajax_assign_user', 'assign_user' );
add_action( 'wp_ajax_nopriv_assign_user', 'assign_user');

add_action( 'wp_ajax_dettach_user', 'dettach_user' );
add_action( 'wp_ajax_nopriv_dettach_user', 'dettach_user');

add_action( 'wp_ajax_get_user_info', 'get_user_infomation' );
add_action( 'wp_ajax_nopriv_get_user_info', 'get_user_infomation');

add_action( 'login_enqueue_scripts', 'theme_login_stylesheet' );

add_shortcode('register_form','theme_register_form');

add_filter( 'manage_users_custom_column', 'filter_manage_users_custom_column', 10, 3 );
add_filter( 'manage_users_columns', 'theme_user_columns' );
add_filter('upload_mimes', 'theme_mime_types');
add_filter('pre_get_users','theme_user_list_filter');
add_filter( 'login_redirect', 'theme_login_redirect', 10, 3 );
add_filter( 'login_headerurl', 'theme_login_logo_url' );
add_filter( 'login_message', 'theme_login_message' );
add_filter('admin_title', 'theme_admin_title', 10, 2);
add_filter( 'login_title','theme_admin_title', 10, 2);
function theme_admin_title($admin_title, $title)
{
    return get_bloginfo('name').' | '.$title;
}

function theme_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }

function theme_admin_head(){
    include 'admin_head.php';
}
function annointed_admin_bar_remove() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
    if(!is_admin())
        $wp_admin_bar->remove_menu('site-name');
}

function theme_admin_init(){
    $role = add_role('member','عضو', array(
        'manage_profile' => true
    ));
    if($role === NULL) $role = get_role('member');
    
}
function theme_admin_bar_menu($wp_admin_bar){
    if(current_user_can('manage_profile')){
        $wp_admin_bar->add_node(array(
            'id'=>'user-info',
            'href'=>admin_url('admin.php?page=member_profile')
        ));
    }

}
function theme_admin_menu(){
    add_menu_page('پروفایل', 'پروفایل','manage_profile', 'member_profile', 'profile_page', 'dashicons-admin-users', 1 );
    add_submenu_page('users.php','پروفایل اعضا', 'پروفایل اعضا','manage_options','member', 'theme_member_page' );
    add_menu_page('لندیما', 'لندیما','manage_options', 'landima', 'landima_page', THEME_DIR.'/images/logo-accent.svg', 2 );
}

function profile_page(){
    $user = get_userdata(get_current_user_id());
    if(!in_array('member',$user->roles)){
        wp_safe_redirect(admin_url('admin.php'));
        exit;
    }
    $idcard = json_decode(str_replace('\\','\/',$user->get('idcard')));
    if($user->has_prop('logo'))
        $logo = json_decode(str_replace('\\','\/',$user->get('logo')));
    $teams = json_decode(get_option('teams'),TRUE);
    include "pages/profile.php";
}
function landima_page(){
    wp_enqueue_script(
        'bootstrap',
        THEME_DIR . '/js/bootstrap.js',
        array('jquery'),
        '1.0.0',
        true );
    wp_enqueue_script(
        'bootstrap_bundle',
        THEME_DIR . '/js/bootstrap.bundle.js',
        array('jquery'),
        '1.0.0',
        true );
    wp_enqueue_script(
        'moment',
        THEME_DIR . '/js/moment.min.js',
        array('jquery'),
        '1.0.0',
        true );
    wp_enqueue_script(
        'jalali_moment',
        THEME_DIR . '/js/moment-jalaali.js',
        array('jquery'),
        '1.0.0',
        true );
    wp_enqueue_script(
        'datepicker',
        THEME_DIR . '/js/daterangepicker.js',
        array('jquery'),
        '1.0.0',
        true );
    wp_enqueue_script(
        'landima',
        THEME_DIR . '/js/landima.js',
        array('jquery'),
        '1.0.0',
        true );
    wp_localize_script( 'landima', 'global',array( 
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'users' => json_encode(get_users('role=member'))
    ) );
    wp_enqueue_style('datepicker',THEME_DIR.'/css/daterangepicker.css');
    $sits = json_decode(get_option('sits'),TRUE);
    include "pages/landima.php";
}
function theme_user_proved_notice() {
    $class = 'notice notice-success is-dismissible';
    $msg = 'کاربر با موفقیت تایید شد.';
    printf('<div class="%1$s"><p>%2$s</p></div>',$class,$msg);
}

function theme_member_page(){
    if(isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'],'prove_member') && get_userdata($_GET['mid'])){
        $user = get_userdata($_GET['mid']);
        update_user_meta($user->ID,'status','proved');
        if($user->get('reg_type') == 'team_master'){
            $teams = json_decode(get_option('teams'),TRUE);
            $id = array_search($user->get('team_name'),$teams);
            if($id){
                $teams[$id] = $user->get('team_name');
                update_option('teams',json_encode($teams));
            }else{
                $id = strtotime('now');
                $teams[$id] = $user->get('team_name');
                update_option('teams',json_encode($teams)); 
            }
            update_user_meta($user->ID,'team',$id);
        }
        add_action( 'admin_notices', 'theme_user_proved_notice' );
    }
    if(isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'],'inactive_member') && get_userdata($_GET['mid'])){
        $user = get_userdata($_GET['mid']);
        update_user_meta($user->ID,'status','inactive');
    }
    if(!isset($_GET['mid']) || !get_userdata($_GET['mid']) ){
        wp_safe_redirect(admin_url('users.php'));
        exit;
    }
    $uid = intval($_GET['mid']);
    $user = get_userdata($uid);
    if(!in_array('member',$user->roles)){
        wp_safe_redirect(admin_url('users.php'));
        exit;
    }
    $idcard = json_decode(str_replace('\\','\/',$user->get('idcard')));
    if($user->has_prop('logo'))
        $logo = json_decode(str_replace('\\','\/',$user->get('logo')));
    
    $teams = json_decode(get_option('teams'),TRUE);
    include "pages/member.php";
}
function theme_register_form(){
    wp_enqueue_script(
        'recaptcha',
        'https://www.google.com/recaptcha/api.js?hl=fa',
        array(),
        '1.0.0',
        true );
    wp_enqueue_script(
        'validator',
        THEME_DIR . '/js/form-validator/jquery.form-validator.js',
        array('jquery'),
        '1.0.0',
        true );
    wp_enqueue_script(
        'prov-city',
        THEME_DIR . '/js/prov-city.js',
        array('jquery'),
        '1.0.0',
        true );
    wp_enqueue_script(
        'register_form',
        THEME_DIR . '/js/register_form.js',
        array('jquery'),
        '1.0.0',
        true );
    wp_localize_script( 'register_form', 'global',array( 
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'login_url' => wp_login_url()
    ) );
    ob_start();
    include 'register_form.php';
    return ob_get_clean();
}
function theme_register_user(){
    include 'register_user.php';
}
function theme_mobile_exists(){
    if(isset($_POST['mobile']) && !empty($_POST['mobile'])){
        $user_query = new WP_User_Query(array(
                'role' => 'member',
                'meta_key' => 'mobile',
                'meta_value' => $_POST['mobile'] 
            ));
        if($user_query->get_results())
            wp_send_json(array('valid'=>false,'message'=>'این شماره موبایل قبلاً ثبت شده است.'));
        else
            wp_send_json(array('valid'=>true));
    }else{
        wp_send_json(array('valid'=>false,'message'=>'مقدار یافت نشد'));
    }  
}
function theme_ncode_exists(){
    if(isset($_POST['ncode']) && !empty($_POST['ncode'])){
        $user_query = new WP_User_Query(array(
                'role' => 'member',
                'meta_key' => 'ncode',
                'meta_value' => $_POST['ncode'] 
            ));
        if($user_query->get_results())
            wp_send_json(array('valid'=>false,'message'=>'این کدملی قبلاً ثبت شده است.'));
        else
            wp_send_json(array('valid'=>true));
    }else{
        wp_send_json(array('valid'=>false,'message'=>'مقدار یافت نشد'));
    }  
}
function theme_username_exists(){
    if (isset($_POST['username']) && !empty($_POST['username'])) {
        if(username_exists( $_POST['username'] ))
            wp_send_json(array('valid'=>false,'message'=>'این نام کاربری قبلاً ثبت شده است.'));
        else
            wp_send_json(array('valid'=>true));
    }else{
        wp_send_json(array('valid'=>false,'message'=>'مقدار یافت نشد'));
    }
}
function theme_email_exists(){
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        if(email_exists( $_POST['email'] ))
            wp_send_json(array('valid'=>false,'message'=>'این آدرس ایمیل قبلاً ثبت شده است.'));
        else
            wp_send_json(array('valid'=>true));
    }else{
        wp_send_json(array('valid'=>false,'message'=>'مقدار یافت نشد'));
    }
}
function theme_delete_user($user_id){
    $user = get_userdata($user_id);
    $sits = json_decode(get_option('sits'),TRUE);
    if(!in_array('member',$user->roles)) return;
    $id = array_search($user_id,$sits);
    if($id){
        unset($sits[$id]);
        update_option('sits',json_encode($sits));
    }
    $idcard = json_decode(str_replace('\\','\/',$user->get('idcard')));
    wp_delete_file($idcard->file);
    $logo =  json_decode(str_replace('\\','\/',$user->get('logo')));
    wp_delete_file($logo->file);
}
function theme_user_columns($column) {
    $column['reg_type'] = 'نوع عضویت';
    $column['member_status'] = 'وضعیت';
    $column['show_info'] = 'عملیات';
    return $column;
}
function filter_manage_users_custom_column($val, $column_name, $user_id){
    $user = get_userdata($user_id);
    if(!in_array('member',$user->roles)) return '<em class="text-muted">فقط برای اعضا</em>';
    switch ($column_name){
        case 'reg_type':
            return REG_NAMES[get_user_meta($user_id,'reg_type',true)];
        break;
        case "show_info":
            return '<a href="'.admin_url('users.php?page=member&mid='.$user_id).'"><span class="dashicons dashicons-id-alt" title="نمایش اطلاعات"></span></a>';
        break;
        case 'member_status':
            $status = MEM_STATUS[get_user_meta($user_id,'status',true)];
            $color =  MEM_STATUS_COLOR[get_user_meta($user_id,'status',true)];
            return "<span class=\"text-$color\">$status</span>";
        break;
    }
    return 'no-data';
}

function theme_user_list_filtering(){
    global $pagenow;
    if (is_admin() && $pagenow == 'users.php') {
        $teams = json_decode(get_option('teams'),TRUE);
        require_once 'user_filter.php';
    }
}
function theme_user_list_filter($query){
    global $pagenow;

    if (is_admin() && $pagenow == 'users.php' && isset($_GET['team']) && !empty($_GET['team'])) {
        $team = wp_strip_all_tags($_GET['team']);
        $meta_query = array(
            array(
                'key' => 'team',
                'value' => $team
            )
        );
        $query->set( 'meta_key', 'team' );
        $query->set( 'meta_query', $meta_query );
    }
    if (is_admin() && $pagenow == 'users.php' && isset($_GET['status']) && !empty($_GET['status'])) {
        $status = wp_strip_all_tags($_GET['status']);
        $meta_query = array(
            array(
                'key' => 'status',
                'value' => $status
            )
        );
        $query->set( 'meta_key', 'status' );
        $query->set( 'meta_query', $meta_query );
    }
    return $query;
}
function theme_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		//check for admins
		if ( in_array( 'member', $user->roles ) ) {
			// redirect them to the default place
			return admin_url('admin.php?page=member_profile');
		} else {
			return $redirect_to;
		}
	} else {
		return $redirect_to;
	}
}
function assign_user_form(){
    $users = new WP_User_Query(array( 
        'exclude' => json_decode(get_option('sits'),TRUE),
        'role' => 'member',
        'meta_key'=>'status',
        'meta_value'=>'proved'
    ) );
    $users = $users->get_results();
    if(!$users){
        wp_send_json(array('message'=>'هیچ کاربری آزادی یافت نشد.'));
    }
    include 'assign_user_form.php';
}
function assign_user(){
    $range = explode(' تا ', $_POST['range']);
    $uid = intval($_POST['uid']);
    $id = intval($_POST['id']);
    $sits = json_decode(get_option('sits'),TRUE);
    update_user_meta($uid,'start_date',$range[0]);
    update_user_meta($uid,'end_date',$range[1]);
    update_user_meta($uid,'sit',$id);
    $sits[$id] = $uid;
    update_option('sits',json_encode($sits));
    wp_send_json('OK');
}
function get_user_infomation(){
    $user = get_userdata($_POST['uid']);
    $names = array(
        'freelancer'=>'فریلنسر',
        'team_master'=>'رهبر تیم',
        'team_member'=>'عضو تیم',
        'traveler'=>'مسافر',
    );
    $teams = json_decode(get_option('teams'),TRUE);
    include 'user_info.php';
    exit;
}

function dettach_user(){
    $uid = intval($_POST['uid']);
    $id = intval($_POST['id']);
    $sits = json_decode(get_option('sits'),TRUE);
    update_user_meta($uid,'start_date','');
    update_user_meta($uid,'end_date','');
    update_user_meta($uid,'sit','');
    unset($sits[$id]);
    update_option('sits',json_encode($sits));
    wp_send_json('OK');
}
function theme_login_stylesheet() {
    wp_enqueue_style( 'login-font', THEME_DIR . '/css/fontiran.css' );
    wp_enqueue_style( 'theme-login', THEME_DIR . '/css/login.css' );
}
function theme_login_message( $message ) {
    if (session_status() == PHP_SESSION_NONE) {
        ob_start();
        session_start();
    }
    if ( isset($_SESSION['register_alert']) && !empty($_SESSION['register_alert']) ){
        $message = $_SESSION['register_alert'];
        unset($_SESSION['register_alert']);
        return "<p class=\"message success\">$message</p>";
    } else {
        return $message;
    }
}
function theme_login_logo_url() {
    return home_url();
}