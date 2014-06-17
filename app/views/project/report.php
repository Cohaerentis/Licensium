<?php
/* @var $this ProjectController */
/* @var $model Project */

$url = Yii::app()->getBaseUrl(true);
$id = e($model->id);
$uuid = e($model->uuid);
$compatibility = $model->compatibility();

?>


<div class="report-content">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="page-title">
                <h2 class="section-title"><?php echo Yii::t('app', 'Project Info'); ?></h2>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 colxs-12">
            <div class="project-report">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="project-info">
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
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-12"><hr /></div>
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="page-title">
                            <h2 class="section-title"><?php echo Yii::t('app', 'Project Issues'); ?></h2>
                        </div>
                    </div>
                    <?php if ($compatibility['status'] != Compatible::STATUS_COMPATIBLE) : ?>
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="alert alert-danger">
                            <p>There are some modules with licenses incompatibility issues:</p>
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
                    <div class="col-lg-12 col-md-12 col-xs-12"><hr /></div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="page-title">
                <h2 class="section-title"><?php echo Yii::t('app', 'Project Modules'); ?></h2>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 colxs-12">
            <div class="modules-report">
                TODO : Show all project modules and status
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12"><hr /></div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="page-title">
                <h2 class="section-title"><?php echo Yii::t('app', 'Share your Project'); ?></h2>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="alert alert-info share-link">
                <p>
                    <strong>
                        Personal user info:
                    </strong>
                </p>
                <p class='report-link ellipsis'>
                  <i class="glyphicon glyphicon-link report-link-icon"></i>
                  <a href="<?php echo $url.'/project/report/id/'.$id.'/code/'.$uuid; ?>"><?php echo $url.'/project/report/id/'.$id.'/code/'.$uuid; ?></a>
                </p>
                <p>
                    <strong>
                        This is a public access, avoid to show.
                    </strong>
                </p>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 colxs-12">
            <div class="print-link">
                <a href="#" class=" btn btn-success right print">
                    <i class="glyphicon glyphicon-print set-right" data-toggle="tooltip"
                    data-original-title="<?php echo Yii::t('app', 'PRINT REPORT'); ?>"></i>
                </a>
            </div>
        </div>
    <div>
</div>