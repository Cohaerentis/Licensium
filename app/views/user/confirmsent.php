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
            </div>
        </div>
    </div>
</div>

