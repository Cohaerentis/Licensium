<?php
/* @var $this ProjectController */
/* @var $model Project */

$url = Yii::app()->getBaseUrl(true);
$id = e($model->id);
$uuid = e($model->uuid);
$compatibility = $model->compatibility();
$available = $model->availableLicenses();
$modules = $model->modules;
$compclasses = array(
  Compatible::STATUS_INCOMPATIBLE => 'incompatible',
  Compatible::STATUS_COMPATIBLE   => 'compatible',
  Compatible::STATUS_UNKNOWN      => 'unknown',
  Compatible::STATUS_DISABLED     => 'disabled',
);

?>

<?php /*
foreach ($modules as $item) {
    echo "<p>".$item->name."</p>";
    echo "<p>".$item->fullLicenseName()."</p>";
    echo "<p>".$item->fullRelation()."</p>";
    echo "<p>".$item->fullType()."</p>";
    echo "<p>".$item->fullIntegrationDate()."</p>";
    echo "____________________________________";
}
*/?>


<div class="report-content">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12"> <?php /* Project-info */ ?>
            <div class="page-title">
                <h2 class="section-title"><?php echo Yii::t('app', 'Project Info'); ?></h2>
            </div>
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
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12"><?php /* Project-licenses */ ?>
            <div class="page-title">
                <h2 class="section-title"><?php echo Yii::t('app', 'Project Licenses'); ?></h2>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="font-faq">
                            <?php echo Yii::t('app','Here you have a list of compatible licenses to be used with your project.'); ?>
                            </div>
                        </div>
                        <div class="project-licenses">
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
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-xs-12"><hr /></div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12"><?php /* Project-modules */ ?>
            <div class="page-title">
                <h2 class="section-title"><?php echo Yii::t('app', 'Project Modules'); ?></h2>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 colxs-12">
            <?php foreach($modules as $item): ?>
                <?php $compatibility = $item->compatibility(); ?>
                <div class="project-modules">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-6">
                                    <div class="value module-title ellipsis">
                                         <i class="glyphicon glyphicon-cog cog"></i>
                                        <?php echo e($item->name); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-6">
                                    <div class="label">
                                        <?php echo e($item->getAttributeLabel('license_id')); ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-6">
                                    <div class="value ellipsis">
                                        <?php if (!empty($license_url)) : ?>
                                        <a href="<?php echo e($license_url); ?>" target="_blank">
                                        <?php endif; ?>
                                            <?php echo e($item->fullLicenseName()); ?>
                                        <?php if (!empty($license_url)) : ?>
                                        </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if (!empty($item->website)) : ?>
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
                        <?php if (!empty($item->repo)) : ?>
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
                        <?php if (!empty($item->relation)) : ?>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-6">
                                    <div class="label">
                                        <?php echo e($item->getAttributeLabel('relation')); ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-6">
                                    <div class="value ellipsis">
                                        <?php echo e($item->fullRelation()); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($item->type)) : ?>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-6">
                                    <div class="label">
                                        <?php echo e($model->getAttributeLabel('type')); ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-6">
                                    <div class="value ellipsis">
                                        <?php echo e($item->fullType()); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($item->createdate)) : ?>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-6">
                                    <div class="label">
                                        <?php echo e($model->getAttributeLabel('integrationdate')); ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-6">
                                    <div class="value ellipsis">
                                        <?php echo e($item->fullIntegrationDate()); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-6">
                                    <div class="label">
                                        <?php echo e($model->getAttributeLabel('status')); ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-6">
                                    <div class="value ellipsis">
                                        <?php echo Compatible::statusPrint($compatibility['status']); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12"><hr /></div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="page-title">
                <h2 class="section-title"><?php echo Yii::t('app', 'Share this Report'); ?></h2>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="alert alert-info share-link">
                <p>
                    <strong>
                        <?php echo Yii::t('app',
                        'This is a public link. Anyone may access to your project report so be carefull 
                        with whom we share it.'
                        );?>
                    </strong>
                </p>
                <p class='report-link ellipsis'>
                  <i class="glyphicon glyphicon-link report-link-icon"></i>
                  <a href="<?php echo $url.'/project/report/id/'.$id.'/code/'.$uuid; ?>"><?php echo $url.'/project/report/id/'.$id.'/code/'.$uuid; ?></a>
                </p>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 colxs-12">
            <div class="print-link">
                <a class=" btn btn-success right print" onClick="window.print()">
                    <i class="glyphicon glyphicon-print set-right" data-toggle="tooltip"
                    data-original-title="<?php echo Yii::t('app', 'PRINT REPORT'); ?>"></i>
                </a>
            </div>
        </div>
    <div>
</div>