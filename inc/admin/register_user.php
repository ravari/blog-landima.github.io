<?php
if ( ! function_exists( 'wp_handle_upload' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
}

if(verify_post_action('save_action','register')){
    if(!username_exists( $_POST['username'] ) && !email_exists( $_POST['email'] ) && $_POST['password'] == $_POST['password_confirm']){
        $user_id = wp_insert_user(array(
            'user_login'=>sanitize_text_field($_POST['username']),
            'user_url'=>sanitize_text_field($_POST['website']),
            'user_email'=>sanitize_text_field($_POST['email']),
            'display_name'=>sanitize_text_field($_POST['name'].' '.$_POST['family']),
            'first_name'=>sanitize_text_field($_POST['name']),
            'last_name'=>sanitize_text_field($_POST['family']),
            'description'=>sanitize_textarea_field($_POST['project_desc']),
            'role'=>'member'
        ));
        if(is_wp_error($user_id))
            wp_send_json(array('success'=>FALSE,'message'=>'ثبت نام انجام نشد، لطفاً اطلاعات وارده را بررسی و دوباره اقدام کنید.'));
        wp_set_password(sanitize_text_field($_POST['password']),$user_id);
        update_user_meta($user_id,'mobile',sanitize_text_field($_POST['mobile']));
        update_user_meta($user_id,'ncode',sanitize_text_field($_POST['ncode']));
        update_user_meta($user_id,'reg_type',sanitize_text_field($_POST['reg_type']));
        update_user_meta($user_id,'status','in_progress');

        if(isset($_FILES['idcard']) && !empty($_FILES['idcard']['tmp_name'])){
            $idcard = wp_handle_upload( $_FILES['idcard'], array('test_form'=>FALSE) );
            if(!$idcard || isset($idcard['error']))
                wp_send_json(array('success'=>FALSE,'message'=>$idcard['error']));
            else
                update_user_meta($user_id,'idcard',json_encode($idcard, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
        switch($_POST['reg_type']){
            case 'freelancer':
                $expertise = $experce = array();
                foreach($_POST['expertise'] as $item) $expertise[] = sanitize_text_field($item);
                foreach($_POST['experce'] as $item) $experce[] = sanitize_text_field($item);
                update_user_meta($user_id,'expertise',json_encode($expertise, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                update_user_meta($user_id,'experce',json_encode($experce, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            break;
            case 'team_master':
                $social = array();
                foreach($_POST['social'] as $item) $social[] = sanitize_text_field($item);
                update_user_meta($user_id,'team_name',sanitize_text_field($_POST['team_name']));
                update_user_meta($user_id,'project_fa',sanitize_text_field($_POST['project_fa']));
                update_user_meta($user_id,'project_en',sanitize_text_field($_POST['project_en']));
                update_user_meta($user_id,'application',sanitize_text_field($_POST['application']));
                update_user_meta($user_id,'project_lvl',sanitize_text_field($_POST['project_lvl']));
                update_user_meta($user_id,'project_target',sanitize_text_field($_POST['project_target']));
                update_user_meta($user_id,'social',json_encode($social, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                if(isset($_FILES['logo']) && !empty($_FILES['logo']['tmp_name'])){
                    $logo = wp_handle_upload( $_FILES['logo'], array('test_form'=>FALSE) );
                    if(!$logo || isset($logo['error']))
                        wp_send_json(array('success'=>FALSE,'message'=>$logo['error']));
                    else
                        update_user_meta($user_id,'project_logo',json_encode($logo, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                }
            break;
            case 'team_member':
                update_user_meta($user_id,'team',sanitize_text_field($_POST['team']));
            break;
            default:
            case 'traveler':
                $expertise = array();
                foreach($_POST['expertise'] as $item) $expertise[] = sanitize_text_field($item);
                update_user_meta($user_id,'province',sanitize_text_field($_POST['province']));
                update_user_meta($user_id,'city',sanitize_text_field($_POST['city']));
                update_user_meta($user_id,'expertise',json_encode($expertise, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            break;
        }
        if (session_status() == PHP_SESSION_NONE) {
            ob_start();
            session_start();
        }
        $_SESSION['register_alert'] = 'ثبت نام با موفقیت انجام شد.';
        wp_send_json('redirect');
    }
}
?>