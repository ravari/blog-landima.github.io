<div class="row latest-post stardust-left">
    <div class=" col-md-6 col-lg-5">
        <?= get_the_post_thumbnail($last['ID'], 'post-thumbnail', array('class'=>'img-fluid br-5'))?>
    </div>
    <div class=" col-md-6 col-lg-7">
        <h3>
            <?=$last['post_title']?>
        </h3>
        <p>
            <?=wp_trim_words($last['post_content'], 50, ' ...')?>
        </p>
        <div class="text-left">
            <a href="<?=get_the_permalink($last['ID'])?>" class="btn btn-primary">
                <?=$atts['more_cap']?>
            </a>
        </div>
    </div>
</div>