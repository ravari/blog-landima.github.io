<div class="wrap container-fluid">
    <div class="row justify-content-between">
        <h1 class="col-auto wp-headline">
            <img src="<?=THEME_DIR?>/images/labels/label_<?=$user->get('sit')?>.jpg" alt="sit" width="40">
            <?=esc_html($user->display_name)?>
        <?php if($user->has_prop('team') && array_key_exists($user->get('team'),$teams)):?>
        &nbsp;|&nbsp;<?=$teams[$user->get('team')]?>
        <?php endif?>
        <small class="text-<?=MEM_STATUS_COLOR[esc_html($user->get('status'))]?>">(<?=MEM_STATUS[esc_html($user->get('status'))]?>)</small>
        </h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-6 col-md-8">
            <div class="row align-items-center">
                <div class="col-sm-3 bg-light text-secondary py-1 mb-1">نام کاربری</div>
                <div class="col-sm-9"><?=esc_html($user->user_login)?></div>

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
            </div>                                                                      
        </div>
        <div class="col-sm-6 col-md-4">
            <img src="<?=$idcard->url?>" class="img-fluid" alt="<?=esc_html($user->user_login)?>">
        </div>
    </div>
    <h6 class="my-3">نوع عضویت: <?=REG_NAMES[esc_html($user->get('reg_type'))]?></h6>
    <hr>
    <div class="row align-items-center">
        <?php if($user->has_prop('province')):?>
        <div class="col-sm-3 bg-light text-secondary py-1 mb-1">استان</div>
        <div class="col-sm-9"><?=esc_html($user->get('province'))?></div>
        <?php endif?>

        <?php if($user->has_prop('city')):?>
        <div class="col-sm-3 bg-light text-secondary py-1 mb-1">شهر</div>
        <div class="col-sm-9"><?=esc_html($user->get('city'))?></div>
        <?php endif?>

        <?php if($user->has_prop('expertise')):?>
        <div class="col-sm-3 bg-light text-secondary py-1 mb-1">تخصص</div>
        <div class="col-sm-9">
        <?php foreach(json_decode($user->get('expertise'),TRUE) as $exp):?>
            <span class="chip"><?=esc_html($exp)?></span>
        <?php endforeach?>
        </div>
        <?php endif?>

        <?php if($user->has_prop('experce')):?>
        <div class="col-sm-3 bg-light text-secondary py-1 mb-1">تجربه های کاری</div>
        <div class="col-sm-9">
        <?php foreach(json_decode($user->get('experce'),TRUE) as $exp):?>
            <span class="chip"><?=esc_html($exp)?></span>
        <?php endforeach?>
        </div>
        <?php endif?>

        <?php if($user->has_prop('team_name')):?>
        <div class="col-sm-3 bg-light text-secondary py-1 mb-1">نام تیم</div>
        <div class="col-sm-9"><?=esc_html($user->get('team_name'))?></div>
        <?php endif?>

        <?php if($user->has_prop('project_fa')):?>
        <div class="col-sm-3 bg-light text-secondary py-1 mb-1">نام طرح به فارسی</div>
        <div class="col-sm-9"><?=esc_html($user->get('project_fa'))?></div>
        <?php endif?>

        <?php if($user->has_prop('project_en')):?>
        <div class="col-sm-3 bg-light text-secondary py-1 mb-1">نام طرح به انگلیسی</div>
        <div class="col-sm-9"><?=esc_html($user->get('project_en'))?></div>
        <?php endif?>

        <?php if($user->has_prop('description') && !empty($user->get('description'))):?>
        <div class="col-sm-3 bg-light text-secondary py-1 mb-1">شرح مختصر طرح</div>
        <div class="col-sm-9"><?=esc_html($user->get('description'))?></div>
        <?php endif?>

        <?php if($user->has_prop('logo')):?>
        <div class="col-sm-3 bg-light text-secondary py-1 mb-1">لوگوی طرح</div>
        <div class="col-sm-9">
            <img src="<?=esc_url($logo->url)?>" class="img-fluid" alt="<?=esc_html($user->get('project_en'))?>">
        </div>
        <?php endif?>

        <?php if($user->has_prop('application')):?>
        <div class="col-sm-3 bg-light text-secondary py-1 mb-1">نام اپلیکیشن</div>
        <div class="col-sm-9"><?=esc_html($user->get('application'))?></div>
        <?php endif?>

        <?php if($user->has_prop('user_url') && !empty($user->get('user_url'))):?>
        <div class="col-sm-3 bg-light text-secondary py-1 mb-1">آدرس وبسایت</div>
        <div class="col-sm-9"><a href="<?=esc_url($user->get('user_url'))?>" target="_blank"><?=esc_html($user->get('user_url'))?></a></div>
        <?php endif?>

        <?php if($user->has_prop('project_lvl')):?>
        <div class="col-sm-3 bg-light text-secondary py-1 mb-1">مرحله محصول</div>
        <div class="col-sm-9"><?=esc_html($user->get('project_lvl'))?></div>
        <?php endif?>

        <?php if($user->has_prop('project_target')):?>
        <div class="col-sm-3 bg-light text-secondary py-1 mb-1">تارگت 3 ماه آینده</div>
        <div class="col-sm-9"><?=esc_html($user->get('project_target'))?></div>
        <?php endif?>

        <?php if($user->has_prop('social')):?>
        <div class="col-sm-3 bg-light text-secondary py-1 mb-1">شبکه های اجتماعی</div>
        <div class="col-sm-9">
        <?php foreach(json_decode($user->get('social'),TRUE) as $social):?>
            <a href="<?=esc_url($social)?>"><?=esc_html($social)?></a><br>
        <?php endforeach?>
        </div>
        <?php endif?>
    </div>
</div>