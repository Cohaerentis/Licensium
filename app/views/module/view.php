<?php
/* @var $this ModuleController */
/* @var $model Module */
?>

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="label col-lg-12 col-md-6"><?php echo e($model->getAttributeLabel('name')); ?></div>
            <div class="value col-lg-12 col-md-6"><?php echo e($model->name); ?></div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="label col-lg-12 col-md-6"><?php echo e($model->getAttributeLabel('license_id')); ?></div>
            <div class="value col-lg-12 col-md-6"><?php echo $model->fullLicense(); ?></div>
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
            <div class="label col-lg-12 col-md-6"><?php echo e($model->getAttributeLabel('relation')); ?></div>
            <div class="value col-lg-12 col-md-6"><?php echo e($model->fullRelation()); ?></div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="label col-lg-12 col-md-6"><?php echo e($model->getAttributeLabel('type')); ?></div>
            <div class="value col-lg-12 col-md-6"><?php echo e($model->fullType()); ?></div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="label col-lg-12 col-md-6"><?php echo e($model->getAttributeLabel('integrationdate')); ?></div>
            <div class="value col-lg-12 col-md-6"><?php echo e($model->fullIntegrationDate()); ?></div>
        </div>
    </div>
</div>