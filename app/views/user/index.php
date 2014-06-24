<?php
/* @var $this UserController */
/* @var $model User */

$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('app', 'My profile');
$this->breadcrumbs = array();
?>
<div class="user-wrapper">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="page-title">
                <h2><?php echo Yii::t('app', 'My profile');?></h2>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="field input-group input-group-md">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="input-group-addon"><?php echo e($model->getAttributeLabel('email')); ?></div>
                            </div>
                            <div class="col-lg-10">
                                <div class="form-control"><?php echo e($model->email); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="field input-group input-group-md">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="input-group-addon"><?php echo e($model->getAttributeLabel('firstname')); ?></div>
                            </div>
                            <div class="col-lg-10">
                                <div class="form-control"><?php echo e($model->firstname); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="field input-group input-group-md">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="input-group-addon"><?php echo e($model->getAttributeLabel('lastname')); ?></div>
                            </div>
                            <div class="col-lg-10">
                                <div class="form-control"><?php echo e($model->lastname); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="field input-group input-group-md">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="input-group-addon"><?php echo e($model->getAttributeLabel('company')); ?></div>
                            </div>
                            <div class="col-lg-10">
                                <div class="form-control"><?php echo e($model->company); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="field input-group input-group-md">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="input-group-addon"><?php echo e($model->getAttributeLabel('registerdate')); ?></div>
                            </div>
                            <div class="col-lg-10">
                                <div class="form-control"><?php echo e($model->registerDatePrint()); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="field control-btn">
                        <?php echo CHtml::button(Yii::t('app', 'Edit my profile'),
                            array('class'  => 'btn btn-success', 'submit' => array('/user/update')));
                        ?>
                        <?php echo CHtml::button(Yii::t('app', 'Change password'),
                            array('class'  => 'btn btn-success', 'submit' => array('/user/password')));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>