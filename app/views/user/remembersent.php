<?php
/* @var $this UserController */

$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('app', 'Email sent');
$this->breadcrumbs = array();
if (defined('APP_TEST') && !empty($this->test['id'])) {
    $rememberlink = $this->createAbsoluteUrl('user/password', array('id' => $this->test['id'], 'code' => e($this->test['secret'])));
}
?>
<div class="remember-wrapper">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="page-title">
                <h2><?php echo Yii::t('app', 'Email sent');?> <i class="glyphicon glyphicon-exclamation-sign"></i></h2>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="confirm">
                <p><?php echo Yii::t('app', 'If you supplied a correct email address and it is signed up in our database, then an email should have been sent to you.'); ?></p>
                <p>
                    <?php echo Yii::t('app', 'It contains easy instructions to confirm and complete this password change. If you continue to have difficulty, please contact us:'); ?>
                    <a href="mailto:info@opencodex.es">info@opencodex.es</a>
                </p>
                <?php if (defined('APP_TEST') && !empty($this->test['id'])) : ?>
                    <p>
                        <a id="test-remember-link" href="<?php echo $rememberlink; ?>">Test Remember Link</a>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
