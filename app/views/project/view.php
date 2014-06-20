<?php
/* @var $this ProjectController */
/* @var $model Project */

$compatibility = $model->compatibility();
$createdate = $model->createDatePrint();
?>

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="label"><?php echo e($model->getAttributeLabel('name')); ?></div>
            </div>
            <div class="col-lg-12 col-md-6">
                <div class="value"><?php echo e($model->name); ?></div>
            </div>
        </div>
    </div>
    <?php if (!empty($model->website)) : ?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="label"><?php echo e($model->getAttributeLabel('website')); ?></div>
            </div>
            <div class="col-lg-12 col-md-6">
                <div class="value ellipsis"><a href="<?php echo e($model->website); ?>" target="_blank"><?php echo e($model->website); ?></a></div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if (!empty($model->repo)) : ?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="label"><?php echo e($model->getAttributeLabel('repo')); ?></div>
            </div>
            <div class="col-lg-12 col-md-6">
                <div class="value ellipsis"><a href="<?php echo e($model->repo); ?>" target="_blank"><?php echo e($model->repo); ?></a></div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if (!empty($createdate)) : ?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="label"><?php echo e($model->getAttributeLabel('createdate')); ?></div>
            </div>
            <div class="col-lg-12 col-md-6">
                <div class="value"><?php echo e($createdate); ?></div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="col-lg-12 col-md-12 col-xs-12"><hr /></div>
    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="page-title">
            <h2 class="section>-title"><?php echo Yii::t('app', 'License Issues');?>
                <a href="/site/page/view/how-do-we">
                    <i class="glyphicon glyphicon-question-sign set-right" data-toggle="tooltip"
                    data-original-title="<?php echo Yii::t('app', 'How do we calculate compatibility'); ?>"></i>
                </a>
            </h2>
        </div>
    </div>
    <div class="col-md-12 col-xs-12">
        <div class="alt-buttons">
            <a href="/project/report/id/<?php echo e($model->id); ?>/code/<?php echo e($model->uuid); ?>" class="btn-success btn-modules report">
                <?php echo Yii::t('app', 'Report'); ?>
            </a>
            <a href="/module/index/projectid/<?php echo e($model->id); ?>" class="btn-success btn-modules report">
                <?php echo Yii::t('app', 'Modules'); ?>
            </a>
        </div>
    </div>
    <div class="col-md-12 col-xs-12">
        <div class="info-project">
            <ul class="nav nav-tabs">
              <li class="active list-tab "><a href="#modules" data-toggle="tab"><?php echo Yii::t('app', 'Modules'); ?></a></li>
              <li class="list-tab "><a href="#licenses" data-toggle="tab"><?php echo Yii::t('app', 'Project'); ?></a></li>
            </ul>
            <div id="content" class="tab-content">
                <div id="modules" class="tab-pane active">
                    <div class="row">
                        <?php if ($compatibility['status'] != Compatible::STATUS_COMPATIBLE) : ?>
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <div class="alert alert-danger">
                                    <p><?php echo Yii::t('app', 'There are some modules with licenses incompatibility issues:');?></p>
                                    <?php if (!empty($compatibility['conflicts'])) : foreach ($compatibility['conflicts'] as $module): ?>
                                    <i class="glyphicon glyphicon-thumbs-down thumbs" ></i><?php echo $module->name; ?><br>
                                    <?php endforeach; endif; ?>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <div class="alert alert-success">
                                    Well done!! Your project has no compatibility problems.
                                    <i class="glyphicon glyphicon-thumbs-up thumbs" ></i><br>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div id="licenses" class="tab-pane">
                    <div class="comp-title">
                        <h3><?php echo Yii::t('app', 'Available Compatibilities')  ?></h3>
                        <hr />
                    </div>
                    <?php if (!empty($model->license)) : ?>
                        TODO : Show compatibility status of project license
                    <?php else :
                        $available = $model->availableLicenses();
                    ?>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="list-title">
                                <h4><?php echo Yii::t('app', 'Static'); ?></h4><hr />
                            </div>
                            <div class="static-list">
                            <?php if (!empty($available['static'])) : ?>
                                <ul>
                                <?php foreach ($available['static'] as $license): ?>
                                    <li class="ellipsis">
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
                            </div>
                            <?php else : ?>
                                    No license is compatible with project modules
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="list-title">
                                <h4><?php echo Yii::t('app', 'Dinamic'); ?></h4><hr />
                            </div>
                            <div class="dinamic-list">
                            <?php if (!empty($available['dinamic'])) : ?>
                                <ul>
                                <?php foreach ($available['dinamic'] as $license): ?>
                                    <li class="ellipsis">
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
                            </div>
                            <?php else : ?>
                                No license is compatible with project modules
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>