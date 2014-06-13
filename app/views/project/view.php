<?php
/* @var $this ProjectController */
/* @var $model Project */

$compatibility = $model->compatibility();
$createdate = $model->createDatePrint();
?>

<div class="row">
    <?php /*
    <div class="col-md-12">
        <div class="row">
            <div class="label col-lg-12 col-md-6"><?php echo e($model->getAttributeLabel('id')); ?></div>
            <div class="value col-lg-12 col-md-6"><?php echo e($model->id); ?></div>
        </div>
    </div>
    */ ?>
    <div class="col-md-12">
        <div class="row">
            <div class="label col-lg-12 col-md-6"><?php echo e($model->getAttributeLabel('name')); ?></div>
            <div class="value col-lg-12 col-md-6"><?php echo e($model->name); ?></div>
        </div>
    </div>
    <?php if (!empty($model->website)) : ?>
        <div class="col-md-12">
            <div class="row">
                <div class="label col-lg-12 col-md-6"><?php echo e($model->getAttributeLabel('website')); ?></div>
                <div class="value col-lg-12 col-md-6 ellipsis"><a href="<?php echo e($model->website); ?>" target="_blank"><?php echo e($model->website); ?></a></div>
            </div>
        </div>
    <?php endif; ?>
    <?php if (!empty($model->repo)) : ?>
        <div class="col-md-12">
            <div class="row">
                <div class="label col-lg-12 col-md-6"><?php echo e($model->getAttributeLabel('repo')); ?></div>
                <div class="value col-lg-12 col-md-6 ellipsis"><a href="<?php echo e($model->repo); ?>" target="_blank"><?php echo e($model->repo); ?></a></div>
            </div>
        </div>
    <?php endif; ?>
    <?php if (!empty($createdate)) : ?>
        <div class="col-md-12">
            <div class="row">
                <div class="label col-lg-12 col-md-6"><?php echo e($model->getAttributeLabel('createdate')); ?></div>
                <div class="value col-lg-12 col-md-6"><?php echo e($createdate); ?></div>
            </div>
        </div>
    <?php endif; ?>

    <div class="col-lg-12 col-md-12 col-xs-12"><hr /></div>
    <div class="col-lg-12 col-md-12 col-xs-12 page-title">
        <h2 class="section-title"><?php echo Yii::t('app', 'License Issues');?>
            <i class="glyphicon glyphicon-exclamation-sign set-right"></i>
        </h2>
    </div>

    <div class="col-md-12 col-xs-12 alt-buttons">
        <a href="/project/report/id/<?php echo e($model->id); ?>/code/<?php echo e($model->uuid); ?>" class="btn-success btn-modules report">
            <?php echo Yii::t('app', 'Report'); ?>
        </a>
        <a href="/module/index/projectid/<?php echo e($model->id); ?>" class="btn-success btn-modules report">
            <?php echo Yii::t('app', 'Modules'); ?>
        </a>
    </div>
    <div class="col-md-12 col-xs-12 info-project">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#modules" data-toggle="tab"><?php echo Yii::t('app', 'Modules'); ?></a></li>
          <li><a href="#licenses" data-toggle="tab"><?php echo Yii::t('app', 'Project'); ?></a></li>
        </ul>
        <div id="content" class="tab-content">
            <div id="modules" class="tab-pane active">
                <?php if ($compatibility['status'] != Compatible::STATUS_COMPATIBLE) : ?>
                        <div class="col-lg-12 col-md-12 col-xs-12 alert alert-danger">
                        <p>There are some modules with licenses incompatibility issues:</p>
                    <?php if (!empty($compatibility['conflicts'])) : foreach ($compatibility['conflicts'] as $module): ?>
                            <i class="glyphicon glyphicon-thumbs-down thumbs" ></i><?php echo $module->name; ?><br>
                    <?php endforeach; endif; ?>
                        </div>
                    <?php else: ?>
                    <div class="col-lg-12 col-md-12 col-xs-12 alert alert-success">
                        Well done!! Your project has no compatibility problems.
                        <i class="glyphicon glyphicon-thumbs-up thumbs" ></i><br>
                    </div>
                <?php endif; ?>
            </div>
            <div id="licenses" class="tab-pane">
                <h3>Licencia del proyecto</h3>
                <?php if (!empty($model->license)) : ?>
                    TODO : Show compatibility status of project license
                <?php else :
                    $available = $model->availableLicenses();
                ?>
                    <h4><?php echo Yii::t('app', 'Static build'); ?></h4>
                    <?php if (!empty($available['static'])) : ?>
                        <ul>
                        <?php foreach ($available['static'] as $license): ?>
                            <li>
                                <?php if (!empty($license->url)) : ?>
                                    <a href="<?php echo $license->url; ?>" target="_blank">
                                <?php endif; ?>
                                <?php echo $license->name; ?>
                                <?php if (!empty($license->url)) : ?>
                                    </a>
                                <?php endif; ?>
                            </li>
                        <?php endforeach ?>
                        </ul>
                    <?php else : ?>
                        No license is compatible with project modules
                    <?php endif; ?>
                    <h4><?php echo Yii::t('app', 'Dinamic build'); ?></h4>
                    <?php if (!empty($available['dinamic'])) : ?>
                        <ul>
                        <?php foreach ($available['dinamic'] as $license): ?>
                            <li>
                                <?php if (!empty($license->url)) : ?>
                                    <a href="<?php echo $license->url; ?>" target="_blank">
                                <?php endif; ?>
                                <?php echo $license->name; ?>
                                <?php if (!empty($license->url)) : ?>
                                    </a>
                                <?php endif; ?>
                            </li>
                        <?php endforeach ?>
                        </ul>
                    <?php else : ?>
                        No license is compatible with project modules
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>