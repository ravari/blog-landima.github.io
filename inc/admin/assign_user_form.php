<div class="form-group">
    <label for="user">کاربر</label>
    <select id="user" class="form-control">
        <option value="">یک گزینه را انتخاب کنید</option>
        <?php foreach($users as $user):?>
        <option value="<?=$user->ID?>"><?=$user->display_name?></option>
        <?php endforeach?>
    </select>
</div>
<div class="form-group">
    <label for="range">انتخاب بازه فعالیت</label>
    <input type="text" class="form-control" id="range" placeholder="انتخاب تاریخ">
</div>