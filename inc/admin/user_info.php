<div class="container-fluid">
    <input type="hidden" id="uid" value="<?=$user->ID?>">
    <h6 class="mb-3">
        <?=esc_html($user->get('display_name'))?>&nbsp;
        <?=REG_NAMES[$user->get('reg_type')]?>
        <?php if($user->has_prop('team')) echo " ".$teams[$user->get('team')]?>
    </h6>
    <div class="row align-items-center">
        <div class="col-sm-3 bg-light text-secondary py-1 mb-1">نام کاربری</div>
        <div class="col-sm-9">
            <a href="<?=admin_url('users.php?page=member&mid='.$user->ID)?>">
                <?=esc_html($user->user_login)?>
            </a>
        </div>

        <div class="col-sm-3 bg-light text-secondary py-1 mb-1">نام</div>
        <div class="col-sm-9"><?=esc_html($user->first_name)?></div>

        <div class="col-sm-3 bg-light text-secondary py-1 mb-1">نام خانوادگی</div>
        <div class="col-sm-9"><?=esc_html($user->last_name)?></div>

        <div class="col-sm-3 bg-light text-secondary py-1 mb-1">کدملی</div>
        <div class="col-sm-9"><?=esc_html(num($user->get('ncode')))?></div>

        <div class="col-sm-3 bg-light text-secondary py-1 mb-1">شماره موبایل</div>
        <div class="col-sm-9"><?=esc_html(num($user->get('mobile')))?></div>

        <div class="col-sm-3 bg-light text-secondary py-1 mb-1">آدرس ایمیل</div>
        <div class="col-sm-9"><?=esc_html($user->user_email)?></div>

        <div class="col-sm-3 bg-light text-secondary py-1 mb-1">تاریخ شروع</div>
        <div class="col-sm-9"><?=esc_html(num($user->get('start_date')))?></div>

        <div class="col-sm-3 bg-light text-secondary py-1 mb-1">تاریخ پایان</div>
        <div class="col-sm-9"><?=esc_html(num($user->get('end_date')))?></div>
    </div>
</div>