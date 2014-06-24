<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('app', 'Licensium entities');
$this->breadcrumbs = array();

$licenses   = License::getAll();
$relations  = Module::getList('relations');
$types      = Module::getList('types');
?>
<article class="policy-wrapper">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="page-title">
                <h2><?php echo Yii::t('app', 'Licensium entities');?> <i class="glyphicon glyphicon-info-sign"></i></h2>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="faq-licenses">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <h2 class="font-faq"><?php echo Yii::t('app', 'Licenses');?></h2>
                        <hr />
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <ul>
                            <?php foreach ($licenses as $license): ?>
                                <li>
                                    <?php if (!empty($license->url)) : ?>
                                        <a href="<?php echo e($license->url); ?>" target="_blank"><?php echo e($license->name); ?></a>:
                                    <?php else : ?>
                                        <?php echo e($license->name); ?>:
                                    <?php endif; ?>
                                    <?php echo e($license->description); ?>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="faq-relation">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <h2 class="font-faq"><?php echo Yii::t('app', 'Relations');?></h2>
                        <hr />
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <ul>
                            <?php foreach ($relations as $relation): ?>
                                <li>
                                    <?php echo e($relation->name); ?>:
                                    <?php echo e($relation->description); ?>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="faq-type">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <h2 class="font-faq"><?php echo Yii::t('app', 'Types');?></h2>
                        <hr />
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <ul>
                            <?php foreach ($types as $type): ?>
                                <li>
                                    <?php echo e($type->name); ?>:
                                    <?php echo e($type->description); ?>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <p>&nbsp;</p>
        </div>
    </div>
</article>
<?php $this->widget('application.widgets.CookiesWarning'); ?>