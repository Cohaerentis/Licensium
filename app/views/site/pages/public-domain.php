<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('app', 'Public Domain License');
$this->breadcrumbs = array();

?>
<article class="license-wrapper">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="page-title">
                <h2><?php echo Yii::t('app', 'Public Domain License');?> <i class="glyphicon glyphicon-info-sign"></i></h2>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="legal-text">
                <p><?php echo Yii::t('app', 'The author waives all copyrights (all waivable rights) and grants them to public domain.'); ?></p>
            </div>
        </div>
    </div>
</article>
<?php $this->widget('application.widgets.CookiesWarning'); ?>