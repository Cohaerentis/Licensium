<?php
/* @var $this ModuleController */
/* @var $model Module */

$compatibility = $model->compatibility();
$relation = $model->fullRelation();
$type = $model->fullType();
$integrationdate = $model->fullIntegrationDate();
$license_name = $model->fullLicenseName();
$license_url = $model->fullLicenseUrl();
?>

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="label">
                    <?php echo e($model->getAttributeLabel('name')); ?>
                </div>
            </div>
            <div class="col-lg-12 col-md-6">
                <div class="value ellipsis">
                    <?php echo e($model->name); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="label">
                    <?php echo e($model->getAttributeLabel('license_id')); ?><a href="/site/page/view/entities"><span class="span-question">?</span></a>
                </div>
            </div>
            <div class="col-lg-12 col-md-6">
                <div class="value ellipsis">
                    <?php if (!empty($license_url)) : ?>
                    <a href="<?php echo e($license_url); ?>" target="_blank">
                    <?php endif; ?>
                        <?php echo e($license_name); ?>
                    <?php if (!empty($license_url)) : ?>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php if (!empty($model->website)) : ?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="label">
                    <?php echo e($model->getAttributeLabel('website')); ?>
                </div>
            </div>
            <div class="col-lg-12 col-md-6">
                <div class="value ellipsis">
                    <a href="<?php echo e($model->website); ?>" target="_blank">
                        <?php echo e($model->website); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if (!empty($model->repo)) : ?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="label">
                    <?php echo e($model->getAttributeLabel('repo')); ?>
                </div>
            </div>
            <div class="col-lg-12 col-md-6">
                <div class="value ellipsis">
                    <a href="<?php echo e($model->repo); ?>" target="_blank">
                        <?php echo e($model->repo); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if (!empty($relation)) : ?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="label">
                    <?php echo e($model->getAttributeLabel('relation')); ?><a href="/site/page/view/entities"><span class="span-question">?</span></a>
                </div>
            </div>
            <div class="col-lg-12 col-md-6">
                <div class="value ellipsis">
                    <?php echo e($relation); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if (!empty($type)) : ?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="label">
                    <?php echo e($model->getAttributeLabel('type')); ?><a href="/site/page/view/entities"><span class="span-question">?</span></a>
                </div>
            </div>
            <div class="col-lg-12 col-md-6">
                <div class="value ellipsis">
                    <?php echo e($type); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if (!empty($integrationdate)) : ?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="label">
                    <?php echo e($model->getAttributeLabel('integrationdate')); ?>
                </div>
            </div>
            <div class="col-lg-12 col-md-6">
                <div class="value ellipsis">
                    <?php echo e($integrationdate); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($model->enabled)) : ?>
    <div class="col-md-12 col-xs-12">
        <div class="module-status">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="page-title">
                        <h2 class="section-title"><?php echo Yii::t('app', 'Module Status ');?>
                            <a href="/site/page/view/how-do-we">
                                <i class="glyphicon glyphicon-question-sign set-right" data-toggle="tooltip"
                                   data-original-title="<?php echo Yii::t('app', 'How do we calculate compatibility'); ?>"></i>
                            </a>
                        </h2>
                    </div>
                </div>
                <?php if ($compatibility['status'] != Compatible::STATUS_COMPATIBLE) :?>
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="alert alert-danger">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <div class="conflict-status">
                                    <span class="status">Status :</span> <span class="status-result"><?php echo Compatible::statusPrint($compatibility['status']); ?></span>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <table class="table">
                                    <thead>
                                        <tr class="table-conflict">
                                            <th class="col-lg-4 col-md-4 col-xs-4"><?php echo Yii::t('app','Module');?></th>
                                            <th class="col-lg-4 col-md-4 col-xs-4"><?php echo Yii::t('app','License');?></th>
                                            <th class="col-lg-4 col-md-4 col-xs-4"><?php echo Yii::t('app','Result');?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($compatibility['conflicts'] as $id => $conflict): ?>
                                        <tr>

                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                <div class="conflict-list">
                                                    <td><p><?php echo e($conflict['versus']->name); ?></p></td>
                                                    <?php if (!empty($conflict['versus']->license)) : ?>
                                                        <td><?php echo e($conflict['versus']->license->name); ?></td>
                                                        <td><p><?php echo Compatible::statusPrint($conflict['status']); ?></p></td>
                                                    <?php else : ?>
                                                        <td><?php echo Yii::t('app', 'Unknown'); ?></td>
                                                        <td><p><?php echo Compatible::statusPrint($conflict['status']); ?></p></td>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="alert alert-success">
                        <span class="status">Status :</span> <span class="status-result"><?php echo Compatible::statusPrint($compatibility['status']); ?></span>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    <div>
    <?php endif; ?>
</div>