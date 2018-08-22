<div class="wrap">
    <div class="row justify-content-around landibels">
        <?php for($i=1;$i<=24;$i++): $user = get_userdata($sits[$i])?>
            <div class="col-auto landibel<?=(isset($sits[$i])&&intval($sits[$i]))?' taked':' free'?>" 
            data-displayName="<?=$user?$user->get('display_name'):''?>"
            data-uid="<?=$sits[$i]?>"
            data-id="<?=$i?>"
            data-toggle="modal"
            data-target="#userModal">
                <img src="<?=THEME_DIR?>/images/labels/label_<?=$i?>.jpg" class="img-fluid" alt="label-<?=$i?>">
            </div>
        <?php endfor;?>
    </div>
</div>
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userModalTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">لغو</button>
      </div>
    </div>
  </div>
</div>