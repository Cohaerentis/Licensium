<?php
/* @var $this ProjectController */
/* @var $model Project */

$compatibility = $model->compatibility();
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
        <h2>Zona de compatibilidad</h2>
        <h3>Licencia del proyecto</h3>
        <?php if (!empty($model->license)) : ?>
            TODO : Show compatibility status of project license
        <?php else : ?>
            TODO : Show all available licenses, compatible with project modules
        <?php endif; ?>
        <h3>Módulos del proyecto</h3>
        <?php if ($compatibility['status'] != Compatible::STATUS_COMPATIBLE) : ?>
            There are some modules with licenses incompatibility issues:<br>
            <?php if (!empty($compatibility['conflicts'])) : foreach ($compatibility['conflicts'] as $module): ?>
            - <?php echo $module->name; ?><br>
            <?php endforeach; endif; ?>
        <?php endif; ?>
    </div>
    <div class="col-md-6">
        <a href="/project/report/id/<?php echo e($model->id); ?>/code/<?php echo e($model->uuid); ?>" class="btn-success btn-modules">
            <?php echo Yii::t('app', 'Report'); ?>
        </a>
    </div>
    <div class="col-md-6">
        <a href="/module/index/projectid/<?php echo e($model->id); ?>" class="btn-success btn-modules">
            <?php echo Yii::t('app', 'Manage modules'); ?>
        </a>
    </div>

</div>