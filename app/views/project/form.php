<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $form CActiveForm */
?>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'project-form',
    'htmlOptions' => array('class' => 'general-form'),
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
));
?>
  <?php echo $form->errorSummary($model); ?>
  <fieldset class="row">
    <div class="col-lg-12 col-md-12 col-xs-12 field input-group input-group-md">
      <?php echo $form->labelEx($model, 'name', array('class' => 'col-md-6 col-xs-12 input-group-addon')); ?>
      <?php echo $form->textField($model, 'name', array('class' => 'type-text form-control', 'maxlength' => 100)); ?>
      <?php echo $form->error($model, 'name'); ?>
    </div>
    <div class="col-lg-12 col-md-12 col-xs-12 field input-group input-group-md">
      <?php echo $form->labelEx($model, 'website', array('class' => 'col-md-6 col-xs-12 input-group-addon')); ?>
      <?php echo $form->textField($model, 'website', array('class' => 'type-text form-control', 'maxlength' => 256)); ?>
      <?php echo $form->error($model, 'website'); ?>
    </div>
    <div class="col-lg-12 col-md-12 col-xs-12 field input-group input-group-md">
      <?php echo $form->labelEx($model, 'repo', array('class' => 'col-md-6 col-xs-12 input-group-addon')); ?>
      <?php echo $form->textField($model, 'repo', array('class' => 'type-text form-control', 'maxlength' => 256)); ?>
      <?php echo $form->error($model, 'repo'); ?>
    </div>
  </fieldset>
  <fieldset class="row submit">
    <div class="col-md-9 col-sm-6">
      <?php if ($model->isNewRecord) {
          echo CHtml::submitButton('Cancel',
            array('class'       => 'btn btn-link btn-cancel',
                  'data-action' => 'clear'));
      } else {
          echo CHtml::submitButton('Cancel',
            array('class'       => 'btn btn-link btn-cancel',
                  'data-action' => 'view',
                  'data-target' => '/project/view',
                  'data-id'     => e($model->id)));
      } ?>
    </div>
    <div class="col-md-3 col-sm-6">
      <?php if ($model->isNewRecord) {
          echo CHtml::submitButton('Create',
            array('class'       => 'btn btn-success btn-create',
                  'data-action' => 'create',
                  'data-target' => '/project/create'));
      } else {
          echo CHtml::submitButton('Save',
            array('class'       => 'btn btn-success btn-create',
                  'data-action' => 'update',
                  'data-target' => '/project/update',
                  'data-id'     => e($model->id)));
      } ?>
    </div>
  </fieldset>

<?php $this->endWidget(); ?>

