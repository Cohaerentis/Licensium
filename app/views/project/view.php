<?php
/* @var $this ProjectController */
/* @var $model Project */
?>

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="label col-lg-12 col-md-6"><?php echo e($model->getAttributeLabel('id')); ?></div>
            <div class="value col-lg-12 col-md-6"><?php echo e($model->id); ?></div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="label col-lg-12 col-md-6"><?php echo e($model->getAttributeLabel('name')); ?></div>
            <div class="value col-lg-12 col-md-6"><?php echo e($model->name); ?></div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="label col-lg-12 col-md-6"><?php echo e($model->getAttributeLabel('website')); ?></div>
            <div class="value col-lg-12 col-md-6"><?php echo e($model->website); ?></div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="label col-lg-12 col-md-6"><?php echo e($model->getAttributeLabel('repo')); ?></div>
            <div class="value col-lg-12 col-md-6"><?php echo e($model->repo); ?></div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="label col-lg-12 col-md-6"><?php echo e($model->getAttributeLabel('createdate')); ?></div>
            <div class="value col-lg-12 col-md-6"><?php echo e($model->createDatePrint()); ?></div>
        </div>
    </div>
    <div>
        <h2>zona de incompatibilidades</h2>
    </div>
    <div class="col-md-6">
        <a href="/project/public/id/<?php echo e($model->id); ?>/code/<?php echo e($model->uuid); ?>" class="btn-success btn-modules">
            <?php echo Yii::t('app', 'Public link'); ?>
        </a>
    </div>
    <div class="col-md-6">
        <a href="/module/index/projectid/<?php echo e($model->id); ?>" class="btn-success btn-modules">
            <?php echo Yii::t('app', 'Project modules'); ?>
        </a>
    </div>

</div>