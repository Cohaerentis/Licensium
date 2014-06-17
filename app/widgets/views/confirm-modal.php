<div class="modal fade crud-modal <?php echo e($this->class); ?>" <?php if (!empty($id)) : ?> id="<?php echo e($this->id); ?>" <?php endif; ?>
     tabindex="-1" role="dialog" aria-labelledby="ConfirmDeleteModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title custom-modal-title"><?php echo e($this->title); ?></h4>
        </div>
        <div class="modal-body">
          <div class="message-title"><?php echo e($this->heading); ?></div>
          <div class="crud-modalInfo">&nbsp;</div>
        </div>
        <div class="modal-footer">
          <?php if (!empty($this->labelno)) : ?>
            <button type="button" class="modal-btn-no btn-success" data-dismiss="modal">
              <?php echo e($this->labelno); ?>
            </button>
          <?php endif; ?>
          <button type="button" class="modal-btn-yes btn-success"
                  data-action="<?php echo e($this->action); ?>" data-target="<?php echo e($this->target); ?>">
            <?php echo e($this->labelyes); ?>
          </button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
