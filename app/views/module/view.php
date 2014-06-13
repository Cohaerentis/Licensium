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
            <div class="label col-lg-12 col-md-6"><?php echo e($model->getAttributeLabel('name')); ?></div>
            <div class="value col-lg-12 col-md-6"><?php echo e($model->name); ?></div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="label col-lg-12 col-md-6"><?php echo e($model->getAttributeLabel('license_id')); ?></div>
            <div class="value col-lg-12 col-md-6">
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

    <?php if (!empty($model->enabled)) : ?>
        <div class="col-md-12 col-xs-12 module-status">
            <div class="col-lg-12 col-md-12 col-xs-12 page-title">
                <h2 class="section-title"><?php echo Yii::t('app', 'Module Status ');?>
                    <a href="/site/page/view/how-do-we">
                        <i class="glyphicon glyphicon-question-sign set-right" data-toggle="tooltip"
                           data-original-title="<?php echo Yii::t('app', 'How do we calcute compatibility'); ?>"></i>
                    </a>
                </h2>
            </div>
            <?php if ($compatibility['status'] != Compatible::STATUS_COMPATIBLE) :?>
                <div class="col-lg-12 col-md-12 col-xs-12 alert alert-danger">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12 conflict-status">
                            <span class="status">Status :</span> <span class="status-result"><?php echo Compatible::statusPrint($compatibility['status']); ?></span>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr class="table-conflict">
                                <th class="col-lg-4 col-md-4 col-xs-4">Module</th>
                                <th class="col-lg-4 col-md-4 col-xs-4">License</th>
                                <th class="col-lg-4 col-md-4 col-xs-4">Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($compatibility['conflicts'] as $id => $conflict): ?>
                            <tr>

                                <div class="col-lg-12 col-md-12 col-xs-12 conflict-list">
                                    <td><p><?php echo e($conflict['versus']->name); ?></p></td>
                                    <?php if (!empty($conflict['versus']->license)) : ?>
                                        <td><?php echo e($conflict['versus']->license->name); ?></td>
                                        <td><p><?php echo Compatible::statusPrint($conflict['status']); ?></p></td>
                                    <?php else : ?>
                                        <td><?php echo Yii::t('app', 'Unkwon'); ?></td>
                                        <td><p><?php echo Compatible::statusPrint($conflict['status']); ?></p></td>
                                    <?php endif; ?>
                                </div>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="col-lg-12 col-md-12 col-xs-12 alert alert-success">
                    <span class="status">Status :</span> <span class="status-result"><?php echo Compatible::statusPrint($compatibility['status']); ?></span>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>