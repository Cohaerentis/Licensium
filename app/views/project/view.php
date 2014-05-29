<?php
/* @var $this ProjectController */
/* @var $model Project */
?>

<div class="row">
  <div class="col-md-12">
    <span class="label"><?php echo e($model->getAttributeLabel('name')); ?></span>
    <span class="value"><?php echo e($model->name); ?></span>
  </div>
  <div class="col-md-12">
    <span class="label"><?php echo e($model->getAttributeLabel('website')); ?></span>
    <span class="value"><?php echo e($model->website); ?></span>
  </div>
  <div class="col-md-12">
    <span class="label"><?php echo e($model->getAttributeLabel('repo')); ?></span>
    <span class="value"><?php echo e($model->repo); ?></span>
  </div>
  <div class="col-md-12">
    <span class="label"><?php echo e($model->getAttributeLabel('createdate')); ?></span>
    <span class="value"><?php echo e($model->createDatePrint()); ?></span>
  </div>
</div>