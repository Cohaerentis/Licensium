<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('app', 'Update my profile');
$this->breadcrumbs = array();

?>
  <div class="update-wrapper">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'update-form',
        'htmlOptions' => array('class' => 'general-form'),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="page-title">
                <h2><?php echo Yii::t('app', 'Update my profile');?></h2>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <fieldset>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="field input-group input-group-md">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <?php echo $form->labelEx($model, 'email', array('class' => 'input-group-addon')); ?>
                                    <?php echo $form->textField($model, 'email', array('class' => 'type-text form-control', 'maxlength' => 100)); ?>
                                    <?php echo $form->error($model, 'email'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="field input-group input-group-md">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <?php echo $form->labelEx($model, 'firstname', array('class' => 'input-group-addon')); ?>
                                    <?php echo $form->textField($model, 'firstname', array('class' => 'type-text form-control', 'maxlength' => 100)); ?>
                                    <?php echo $form->error($model, 'firstname'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="field input-group input-group-md">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <?php echo $form->labelEx($model, 'lastname', array('class' => 'input-group-addon')); ?>
                                    <?php echo $form->textField($model, 'lastname', array('class' => 'type-text form-control', 'maxlength' => 100)); ?>
                                    <?php echo $form->error($model, 'lastname'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="field input-group input-group-md">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <?php echo $form->labelEx($model, 'company', array('class' => 'input-group-addon')); ?>
                                    <?php echo $form->textField($model, 'company', array('class' => 'type-text form-control', 'maxlength' => 100)); ?>
                                    <?php echo $form->error($model, 'company'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="submit">
                            <?php echo CHtml::submitButton(Yii::t('app', 'Update'),
                                array('class'       => 'btn btn-success')); ?>
                            <?php echo CHtml::linkButton(Yii::t('app', 'Cancel'),
                                array('class'       => 'btn btn-link cancel',
                                      'href'        => '/user')); ?>
                        </div>
                    <div>
                </div>
            </fieldset>
        </div>
    <?php $this->endWidget(); ?>
  </div>
