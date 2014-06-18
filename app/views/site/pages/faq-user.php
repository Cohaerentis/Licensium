<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
    'About',
);
?>
<article class="policy-wrapper">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="page-title">
                <h2><?php echo Yii::t('app', 'User FAQ');?> <i class="glyphicon glyphicon-info-sign"></i></h2>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="faq-licenses">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <h2 class="font-faq"><?php echo Yii::t('app', 'Licenses');?></h2>
                        <hr />
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <pre>
                        Licenses
                        </pre>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="faq-relation">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <h2 class="font-faq"><?php echo Yii::t('app', 'Relations');?></h2>
                        <hr />
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <pre>
                            Types
                        </pre>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="faq-type">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <h2 class="font-faq"><?php echo Yii::t('app', 'Types');?></h2>
                        <hr />
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <pre>
                            Types
                        </pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>