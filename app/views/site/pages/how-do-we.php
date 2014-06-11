<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - How do we';
$this->breadcrumbs=array(
    'How do we...',
);
?>
<article class="about-wrapper">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12 page-title">
            <h2><?php echo Yii::t('app', 'How do we calculate compatibility');?> <i class="glyphicon glyphicon-info-sign"></i></h2>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12 about-text">
            <p><pre>
                <?php
                echo Yii::t(
                    'app',
                    'Explicacion de como ' .
                    'calculamos las compatibilidades'
                    );
                    ?>
                </pre>
            </p>
    </div>
</article>