<link rel="stylesheet" href="<?=THEME_DIR?>/css/bootstrap-rtl.css">
<link rel="stylesheet" href="<?=THEME_DIR?>/css/fontiran.css">
<link rel="stylesheet" href="<?=THEME_DIR?>/css/font-awesome.css">
<style type="text/css">
    html {
        font-size: 13px;
    }

    .input-group-prepend .input-group-text {
        border-top-right-radius: 5px !important;
        border-bottom-right-radius: 5px !important;
        border-bottom-left-radius: 0;
        border-top-left-radius: 0;
        border-left: none;
    }

    .input-group .form-control:not(:first-child),
    .input-group .custom-select:not(:first-child) {
        border-top-left-radius: 5px !important;
        border-bottom-left-radius: 5px !important;
        border-bottom-right-radius: 0;
        border-top-right-radius: 0;
    }

    select {
        flex: 1 1 1%;
    }
</style>
<div class="m-3">
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text" for="latest-post-category">انتخاب دسته</label>
        </div>
        <?php
        wp_dropdown_categories(array(
            'hide_empty'   => 0,
            'name'         => 'latest-post-category form-control',
            'id'           => 'latest-post-category',
            'hierarchical' => true
        ));
    ?>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text" for="latest-post-more-cap">برچسب ادامه مطلب</label>
        </div>
        <input type="text" name="more_cap" id="latest-post-more-cap" class="form-control" placeholder="ادامه مطلب">
    </div>
    <div class="text-left">
        <button class="btn btn-primary mt-5">افزودن</button>
        <button class="btn btn-secondary mt-5">لغو</button>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script>
    jQuery(document).ready(function($) {
        $('.btn-primary').on('click', function() {
            var cat = $('#latest-post-category').val(),
                cap = $('#latest-post-more-cap').val(),
                out = '[latest_post';
            out += ' cat="' + cat + '"';
            if (cap !== "")
                out += ' more_cap="' + cap + '"';
            out += ']';
            top.tinymce.activeEditor.execCommand("mceInsertContent", false, out);
            top.tinymce.activeEditor.windowManager.close();
        })
        $('.btn-secondary').on('click', function() {
            top.tinymce.activeEditor.windowManager.close();
        })
    })
</script>