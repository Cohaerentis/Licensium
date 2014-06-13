<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm  */

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
        <div class="col-lg-12 col-md-12 col-xs-12 page-title">
            <h2><?php echo Yii::t('app', 'Update my profile');?></h2>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
              <fieldset class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 field input-group input-group-md">
                  <?php echo $form->labelEx($model, 'email', array('class' => 'col-xs-6 input-group-addon')); ?>
                  <?php echo $form->textField($model, 'email', array('class' => 'type-text form-control', 'maxlength' => 100)); ?>
                  <?php echo $form->error($model, 'email'); ?>
                </div>
                <div class="col-lg-12 col-md-12 col-xs-12 field input-group input-group-md">
                  <?php echo $form->labelEx($model, 'firstname', array('class' => 'col-xs-6 input-group-addon')); ?>
                  <?php echo $form->textField($model, 'firstname', array('class' => 'type-text form-control', 'maxlength' => 100)); ?>
                  <?php echo $form->error($model, 'firstname'); ?>
                </div>
                <div class="col-lg-12 col-md-12 col-xs-12 field input-group input-group-md">
                  <?php echo $form->labelEx($model, 'lastname', array('class' => 'col-xs-6 input-group-addon')); ?>
                  <?php echo $form->textField($model, 'lastname', array('class' => 'type-text form-control', 'maxlength' => 100)); ?>
                  <?php echo $form->error($model, 'lastname'); ?>
                </div>
                <div class="col-lg-12 col-md-12 col-xs-12 field input-group input-group-md">
                  <?php echo $form->labelEx($model, 'company', array('class' => 'col-xs-6 input-group-addon')); ?>
                  <?php echo $form->textField($model, 'company', array('class' => 'type-text form-control', 'maxlength' => 100)); ?>
                  <?php echo $form->error($model, 'company'); ?>
                </div>
              </fieldset>
              <fieldset class="row submit">
                <?php echo CHtml::submitButton(Yii::t('app', 'Update'),
                    array('class'       => 'btn btn-success')); ?>
                <?php echo CHtml::linkButton(Yii::t('app', 'Cancel'),
                    array('class'       => 'btn btn-link cancel',
                          'href'        => '/user')); ?>
              </fieldset>
        </div>
    <?php $this->endWidget(); ?>
  </div>
