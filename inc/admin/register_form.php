<?php
global $wp;

if (verify_post_action('save_action', 'register')) {
    echo '<pre dir="ltr" style="text-align:left">';
    var_dump($_POST);
    var_dump($_FILES);
    echo '</pre>';
}

$teams = json_decode(get_option('teams'), true);
?>
    <div class="alert alert-dismissible fade" role="alert" id="message"></div>

    <form action="<?=home_url($wp->request)?>" method="POST" enctype="multipart/form-data" id="registration-form">
        <?php wp_nonce_field('save_action', 'register');?>
        <div class="row">
            <div class="form-group col-md-4">
                <input type="text" class="form-control" name="username" maxlength="50" placeholder="نام کاربری" data-validation="required server"
                    data-validation-url="<?=admin_url('admin-ajax.php')?>?action=username_exists">
            </div>
            <div class="form-group col-md-4">
                <input type="text" class="form-control" name="name" placeholder="نام" data-validation="required">
            </div>
            <div class="form-group col-md-4">
                <input type="text" class="form-control" name="family" placeholder="نام خانوادگی" data-validation="required">
            </div>
            <div class="form-group col-md-4">
                <input type="text" class="form-control" name="mobile" maxlength="11" placeholder="شماره همراه" data-validation="required mobile_num server"
                    data-validation-url="<?=admin_url('admin-ajax.php')?>?action=mobile_exists">
            </div>
            <div class="form-group col-md-4">
                <input type="text" class="form-control" name="ncode" maxlength="10" placeholder="کدملی" data-validation="required code_meli server"
                    data-validation-url="<?=admin_url('admin-ajax.php')?>?action=ncode_exists">
            </div>
            <div class="form-group col-md-4">
                <label for="idcard" class="btn btn-block upload req">بارگزاری اسکن کارت ملی</label>
                <input type="file" class="form-control" id="idcard" name="idcard" data-validation-allowing="jpg" data-validation-max-size="512kb"
                    data-validation="required mime size">
            </div>
            <div class="form-group col-md-4">
                <input type="email" class="form-control" name="email" placeholder="آدرس ایمیل" data-validation="required email server" data-validation-url="<?=admin_url('admin-ajax.php')?>?action=email_exists">
            </div>
            <div class="form-group col-md-4 position-relative">
                <input type="password" class="form-control" name="password" placeholder="رمزعبور" data-validation="required length" data-validation-length="min8">
            </div>
            <div class="form-group col-md-4">
                <input type="password" class="form-control" name="password_confirm" placeholder="تکرار رمزعبور" data-validation="required confirmation"
                    data-validation-confirm="password">
            </div>
            <div class="col-12 my-3">
                <span>نوع عضویت:</span>
                <div class="btn-group btn-group-toggle cond-choises" data-toggle="buttons">
                    <label class="btn btn-light<?=isset($_GET['reg_type'])&&$_GET['reg_type']=='freelancer'?' active':''?>">
                        <input type="radio" name="reg_type" value="freelancer" id="option1"<?=isset($_GET['reg_type'])&&$_GET['reg_type']=='freelancer'?' checked="checked"':''?>> فریلنسر
                    </label>
                    <label class="btn btn-light">
                        <input type="radio" name="reg_type" value="team_master" id="option2"> رهبر تیم
                    </label>
                    <label class="btn btn-light<?=isset($_GET['reg_type'])&&$_GET['reg_type']=='team_member'?' active':''?>">
                        <input type="radio" name="reg_type" value="team_member" id="option3"<?=isset($_GET['reg_type'])&&$_GET['reg_type']=='team_member'?' checked="checked"':''?>> عضو تیم
                    </label>
                    <label class="btn btn-light<?=isset($_GET['reg_type'])&&$_GET['reg_type']=='traveler'?' active':''?>">
                        <input type="radio" name="reg_type" value="traveler" id="option4"<?=isset($_GET['reg_type'])&&$_GET['reg_type']=='traveler'?' checked="checked"':''?>> مسافر
                    </label>
                </div>
            </div>
            <div class="form-group col-md-6 cond" data-cond="traveler">
                <select name="province" class="form-control" id="reg_province" data-validation="required">
                    <option value="">استان</option>
                </select>
            </div>
            <div class="form-group col-md-6 cond" data-cond="traveler">
                <select name="city" class="form-control" id="reg_city" data-validation="required">
                    <option value="">شهر</option>
                </select>
            </div>
            <div class="repeater cond" data-cond="traveler,freelancer" data-max="5">
                <div class="form-group repeat">
                    <input type="text" class="form-control" name="expertise[]" placeholder="تخصص" data-validation="required">
                </div>
            </div>
            <div class="repeater cond" data-cond="freelancer" data-max="10">
                <div class="form-group repeat">
                    <input type="text" class="form-control" name="experce[]" placeholder="تجربه های کاری">
                </div>
            </div>
            <div class="form-group col-md-4 cond" data-cond="team_master">
                <input type="text" class="form-control" name="team_name" placeholder="نام تیم" data-validation="required">
            </div>
            <div class="form-group col-md-4 cond" data-cond="team_master">
                <input type="text" class="form-control" name="project_fa" placeholder="نام طرح به فارسی" data-validation="required">
            </div>
            <div class="form-group col-md-4 cond" data-cond="team_master">
                <input type="text" class="form-control" name="project_en" placeholder="نام طرح به انگلیسی" data-validation="required">
            </div>
            <div class="form-group col-md-4 cond" data-cond="team_master">
                <input type="text" class="form-control" name="application" placeholder="نام اپلیکیشن">
            </div>
            <div class="form-group col-md-4 cond" data-cond="team_master">
                <input type="url" class="form-control" name="website" placeholder="آدرس وبسایت" data-validation="url" data-validation-optional="true">
            </div>
            <div class="form-group col-md-4 cond" data-cond="team_master">
                <label for="logo_file" class="btn btn-block upload">بارگزاری لوگوی طرح</label>
                <input type="file" class="form-control" id="logo_file" name="logo" data-validation-allowing="png" data-validation-max-size="2mb"
                    data-validation="mime size">
            </div>
            <div class="form-group col-md-12 cond" data-cond="team_master">
                <textarea name="project_desc" placeholder="شرح مختصری از طرح" data-validation="required"></textarea>
            </div>
            <div class="col-12 options cond" data-cond="team_master">
                <div class="row my-3">
                    <div class="col-12">در چه مرحله ای از محصول می باشید؟</div>
                    <div class="col-sm-auto">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="lvl-1" name="project_lvl" value="ايده" class="custom-control-input" data-validation="required">
                            <label class="custom-control-label" for="lvl-1">ايده</label>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                            <div class="custom-control custom-radio">
                            <input type="radio" id="lvl-2" name="project_lvl" value="تيم سازي" class="custom-control-input">
                            <label class="custom-control-label" for="lvl-2">تيم سازي</label>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="lvl-3" name="project_lvl" value="نمونه اوليه محصول" class="custom-control-input">
                            <label class="custom-control-label" for="lvl-3">نمونه اوليه محصول</label>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="lvl-4" name="project_lvl" value="محصول نهايى" class="custom-control-input">
                            <label class="custom-control-label" for="lvl-4">محصول نهايى</label>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="lvl-5" name="project_lvl" value="جذب سرمايه گذار" class="custom-control-input">
                            <label class="custom-control-label" for="lvl-5">جذب سرمايه گذار</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-12 cond" data-cond="team_master">
                <input type="text" class="form-control" name="project_target" placeholder="تارگت ۳ ماهه آینده شما چه می باشد؟" data-validation="required">
            </div>
            <div class="repeater cond" data-cond="team_master" data-max="5">
                <div class="form-group repeat">
                    <input type="url" class="form-control" name="social[]" placeholder="آدرس شبکه های اجتماعی" data-validation="url" data-validation-optional="true">
                </div>
            </div>
            <div class="form-group col-md-6 cond" data-cond="team_member">
                <select name="team" class="form-control" data-validation="required">
                    <option value="">لطفاً تیم خود را انتخاب کنید</option>
                    <?php foreach ($teams as $key=>$val):?>
                    <option value="<?=$key?>">
                        <?=$val?>
                    </option>
                    <?php endforeach?>
                </select>
            </div>
        </div>
        <button  
        type="submit" class="btn btn-success g-recaptcha cond" 
        data-cond="traveler,freelancer,team_master,team_member" 
        data-sitekey="6LcDdkYUAAAAANEFPlos6LSpjagMpn2q-ed1uMbH" 
        data-invisible="true" 
        data-callback="sendform"
        disabled>ثبت نام</button>
    </form>