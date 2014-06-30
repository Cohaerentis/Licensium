<?php
/* @var $this UserController */

$title = Yii::t('app', 'Registry completed');
if ($context == 'resend') {
    $title = Yii::t('app', 'Confirmation code resent');
} else if ($context == 'update') {
    $title = Yii::t('app', 'Email updated');
}
$this->pageTitle = Yii::app()->name . ' - ' . $title;
$this->breadcrumbs = array();
if (defined('APP_TEST')) {
    $confirmlink = $this->createAbsoluteUrl('user/confirm', array('id' => $model->id, 'code' => e($this->test['secret'])));
}

?>
<div class="confirm-wrapper">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="page-title">
                <h2>
                    <?php echo $title;?>
                    <i class="glyphicon glyphicon-ok"></i>
                </h2>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="confirm">
                <p><?php echo Yii::t('app', 'You will receive a confirmation email to validate your account.');?></p>
                <p><?php echo Yii::t('app', 'Follow the instructions and click the link provided to end the registry.');?></p>
                <?php if (defined('APP_TEST')) : ?>
                    <p>
                        <a id="test-confirm-link" href="<?php echo $confirmlink; ?>">Test Confirm Link</a>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

