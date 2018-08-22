<?php wp_nonce_field('save_landstars_meta', '_themenonce')?>
<input type="text" class="form-control my-1" name="lns_date" placeholder="تاریخ برگزاری" value="<?=get_post_meta($post->ID, 'lns_date', true)?>">
<input type="text" class="form-control my-1" name="lns_time" placeholder="ساعت برگزاری" value="<?=get_post_meta($post->ID, 'lns_time', true)?>">
<input type="text" class="form-control my-1" name="lns_location" placeholder="مکان برگزاری" value="<?=get_post_meta($post->ID, 'lns_location', true)?>">
<input type="text" class="form-control my-1" name="lns_capacity" placeholder="ظرفیت شرکت کنندگان" value="<?=get_post_meta($post->ID, 'lns_capacity', true)?>">