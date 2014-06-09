<?php
/* @var $this ModuleController */
/* @var $model Module */

$compatibility = $model->compatibility();
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

    <div>
        <h2>zona de incompatibilidades</h2>
        <pre>
        Global : <?php echo Compatible::statusPrint($compatibility['status']); ?>
        </pre>
        <?php if ($compatibility['status'] != Compatible::STATUS_COMPATIBLE) : foreach ($compatibility['conflicts'] as $id => $conflict): ?>
            <?php if (!empty($conflict['versus']->license)) : ?>
                - (<?php echo Compatible::statusPrint($conflict['status']); ?>/<?php echo e($conflict['versus']->license->name); ?>)
            <?php else : ?>
                - (<?php echo Compatible::statusPrint($conflict['status']); ?>)
            <?php endif; ?>
            <?php echo e($conflict['versus']->name); ?><br>
        <?php endforeach; endif; ?>
    </div>
</div>