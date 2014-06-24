<?php
/* @var $this UserController */

$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('app', 'Email Confirmation Complete');
$this->breadcrumbs = array();
?>
<div class="confirm-wrapper">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="page-title">
                <h2><?php echo Yii::t('app', 'Email Confirmation Complete');?> <i class="glyphicon glyphicon-ok"></i></h2>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="confirm">
                <p><?php echo Yii::t('app', 'Email confirmation has been completed succesfully.');?></p>
                <p><?php echo Yii::t('app', 'Now you can log in the application with your user and password.');?></p>
            </div>
        </div>
    </div>
</div>
