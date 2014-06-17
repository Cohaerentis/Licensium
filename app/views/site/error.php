<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
    'Error',
);

$msg = '';
if($code==404) {
    $msg = Yii::t('app', 'May be your memory is getting worse or perhaps your fingers are too fat...');
}
if($code==401) {
    $msg = Yii::t('app', 'Oh, dude!! That´s not the way. But you can keep trying.');
}

?>

<div class="center-error">
    <div class="row">
    <div class="col-lg-12">
        <div class="back">
            <div class="error-title">
                <h2>Error <?php echo $code; ?></h2>
            </div>
            <div class="error">
                <strong><?php echo CHtml::encode($message); ?></strong>
                <p><?php echo $msg; ?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div id='monster'>
            <img src="/img/monster.png"/>
        </div>
    </div>
    </div>
</div>

