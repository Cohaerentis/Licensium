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
                <h2><?php echo Yii::t('app', 'Legal Notice and Conditions of Use');?> <i class="glyphicon glyphicon-info-sign"></i></h2>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="about-text">
                <p>
                    <?php
                        echo Yii::t(
                            'app',
                            'Write here your Legal Notice & Conditions of Use. ' .
                            'No other thing but your Legal Notice & Conditions of Use.'
                        );
                    ?>
                </p>Legal Notice & Conditions of Use
            </div>
        </div>
    </div>
</article>