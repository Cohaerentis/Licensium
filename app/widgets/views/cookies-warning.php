<?php if (!isset(Yii::app()->request->cookies['licensium_cookies_acknowlegde'])) : ?>
<div id="cookies-modal" class="modal fade"
     tabindex="-1" role="dialog" aria-labelledby="CookiesModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><?php echo Yii::t('app', 'Cookies warning'); ?></h4>
        </div>
        <div class="modal-body">
          <?php echo Yii::t('app', 'We use owned and third-party cookies to improve service. If you continue navigating we understand you accept our'); ?>
          <a href="/site/page/view/cookies-policy"><?php echo Yii::t('app', 'cookies policy'); ?></a>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn" data-dismiss="modal" id="btn-cookies-modal-ok">
            OK
          </button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>