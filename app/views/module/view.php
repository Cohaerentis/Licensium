<?php
/* @var $this ModuleController */
/* @var $model Module */

$compatibility = $model->compatibility();
$relation = $model->fullRelation();
$type = $model->fullType();
$integrationdate = $model->fullIntegrationDate();
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
    <?php if (!empty($model->website)) : ?>
        <div class="col-md-12">
            <div class="row">
                <div class="label col-lg-12 col-md-6"><?php echo e($model->getAttributeLabel('website')); ?></div>
                <div class="value col-lg-12 col-md-6"><a href="<?php echo e($model->website); ?>" target="_blank"><?php echo e($model->website); ?></a></div>
            </div>
        </div>
    <?php endif; ?>
    <?php if (!empty($model->repo)) : ?>
        <div class="col-md-12">
            <div class="row">
                <div class="label col-lg-12 col-md-6"><?php echo e($model->getAttributeLabel('repo')); ?></div>
                <div class="value col-lg-12 col-md-6"><a href="<?php echo e($model->repo); ?>" target="_blank"><?php echo e($model->repo); ?></a></div>
            </div>
        </div>
    <?php endif; ?>
    <?php if (!empty($relation)) : ?>
    <div class="col-md-12">
        <div class="row">
            <div class="label col-lg-12 col-md-6"><?php echo e($model->getAttributeLabel('relation')); ?></div>
            <div class="value col-lg-12 col-md-6"><?php echo e($relation); ?></div>
        </div>
    </div>
    <?php endif; ?>
    <?php if (!empty($type)) : ?>
    <div class="col-md-12">
        <div class="row">
            <div class="label col-lg-12 col-md-6"><?php echo e($model->getAttributeLabel('type')); ?></div>
            <div class="value col-lg-12 col-md-6"><?php echo e($type); ?></div>
        </div>
    </div>
    <?php endif; ?>
    <?php if (!empty($integrationdate)) : ?>
    <div class="col-md-12">
        <div class="row">
            <div class="label col-lg-12 col-md-6"><?php echo e($model->getAttributeLabel('integrationdate')); ?></div>
            <div class="value col-lg-12 col-md-6"><?php echo e($integrationdate); ?></div>
        </div>
    </div>
    <?php endif; ?>

    <div>
        <h2>zona de incompatibilidades</h2>
        TODO : Poner una ? que enlace a una página estática que explica cómo se calcula la compatibilidad de módulos, y cómo afecta el cambio de prioridad de un módulo
        <pre>
        Status : <?php echo Compatible::statusPrint($compatibility['status']); ?>
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