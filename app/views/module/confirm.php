<?php
/* @var $this ModuleController */
/* @var $model Module */
?>

<div class="row">
  <div class="col-md-12">
    <span class="label"><?php echo e($model->getAttributeLabel('name')); ?></span>
    <span class="value"><?php echo e($model->name); ?></span>
  </div>
</div>