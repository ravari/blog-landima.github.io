<div class="float-left mr-5">
    <span class="cap">تیم ها:</span>
    <select name="team" class="float-left mr-2 team-filter">
        <option value="">همه</option>
        <?php foreach($teams as $key => $val):?>
        <option value="<?=$key?>" <?=$key==wp_strip_all_tags($_GET[ 'team'])? ' selected': ''?>>
            <?=$val?>
        </option>
        <?php endforeach?>
    </select>
</div>
<div class="float-left mr-5">
    <span class="cap">وضعیت:</span>
    <select name="status" class="float-left mr-2 status-filter">
        <option value="">همه</option>
        <?php foreach(MEM_STATUS as $key => $val):?>
        <option value="<?=$key?>" <?=$key==wp_strip_all_tags($_GET[ 'status'])? ' selected': ''?>>
            <?=$val?>
        </option>
        <?php endforeach?>
    </select>
</div>

<script>
    jQuery(document).ready(function($) {
        $('.team-filter, .status-filter').on('change', function() {
            $(this).parents('form').eq(0).submit()
        })
    })
</script>