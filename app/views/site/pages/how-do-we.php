<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - How do we';
$this->breadcrumbs=array(
    'How do we...',
);
?>
<article class="about-wrapper">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="page-title">
                <h2><?php echo Yii::t('app', 'How do we calculate compatibility');?> <i class="glyphicon glyphicon-info-sign"></i></h2>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="how-text">
                <p>
                    <?php echo Yii::t('app', 'The first thing we have to do before comparing modules is creating a new project and add some modules so they can be compare.'); ?>
                </p>
                <div class="images">
                    <img src="/img/how-1.png"/>
                </div>
                <p>
                    <?php echo Yii::t('app', 'Once our project is created, we have to select it so we can add some modules by pressing the "Modules" button.');?>
                </p>
                <div class="images">
                    <img src="/img/how-2.png"/>
                </div>
                <p><?php echo Yii::t('app', 'Once we are in modules screen, we can create one or edit any we had already created.');?></p>
                <p><?php echo Yii::t('app', 'The modules are created  from bottom to top and that is its priority.');?></p>
                <div class="images">
                    <img src="/img/how-3.png"/>
                </div>
                <p><?php echo Yii::t('app', 'Here we here can see the compatibility of the module with the one below. The first is compare with none; the second with the first, the third with the second and with the first and so on.');?></p>
                <p><?php echo Yii::t('app', 'We can add a lower or a higher priority by using the arrow provided with each module.');?></p>
                <p><?php echo Yii::t('app', 'The compatibility of the modules is determined by the color of the screw.');?>
                <div class="images small">
                    <img src="/img/how-4.png"/>
                </div>
                <ul>
                    <li><strong>GREEN:</strong> the module is compatible with one/all the modules below</li>
                    <li><strong>RED:</strong> the module is incompatible with one/all the modules below</li>
                    <li><strong>ORANGE:</strong> The status of the compatibility is unknown.</li>
                </ul>
                <p><?php echo Yii::t('app', 'When we press a module, on the right side of the screen, we will see the module status.');?></p>
                <p><?php echo Yii::t('app', 'There you can see where is the compatibility problem with that module.');?></p>
                <div class="images small">
                    <img src="/img/how-5.png"/>
                </div>
                <div class="images small">
                    <img src="/img/how-6.png"/>
                </div>
                <p><?php echo Yii::t('app', 'We can also deactivate the module by pressing the eye icon. This way, that module will not be taken into account in the compatibilty test.')?></p>
                 <div class="images small">
                    <img src="/img/how-7.png"/>
                </div>
                <div class="images small">
                    <img src="/img/how-8.png"/>
                </div>
                <p><?php echo Yii::t('app', 'By pressing the “report” button we will get a full report and a link to share it.');?></p>
                <div class="images">
                    <img src="/img/how-9.png"/>
                </div>
            </div>
        </div>
    </div>
</article>