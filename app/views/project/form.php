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
<fieldset>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="field input-group input-group-md">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <?php echo $form->labelEx($model, 'name', array('class' => 'input-group-addon')); ?>
                    </div>
                    <div class="col-xs-12">
                    <?php echo $form->textField($model, 'name', array('class' => 'type-text form-control', 'maxlength' => 100)); ?>
                    </div>
                    <div class="col-xs-12">
                    <?php echo $form->error($model, 'name'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="field input-group input-group-md">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <?php echo $form->labelEx($model, 'website', array('class' => 'col-md-6 col-xs-12 input-group-addon')); ?>
                    </div>
                    <div class="col-xs-12">
                        <?php echo $form->textField($model, 'website', array('class' => 'type-text form-control', 'maxlength' => 256)); ?>
                    </div>
                    <div class="col-xs-12">
                        <?php echo $form->error($model, 'website'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="field input-group input-group-md">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <?php echo $form->labelEx($model, 'repo', array('class' => 'col-md-6 col-xs-12 input-group-addon')); ?>
                    </div>
                    <div class="col-xs-12">
                        <?php echo $form->textField($model, 'repo', array('class' => 'type-text form-control', 'maxlength' => 256)); ?>
                    </div>
                    <div class="col-xs-12">
                        <?php echo $form->error($model, 'repo'); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php /* AEA - Disabled in first version if (!$model->isNewRecord): ?>
    <div class="col-lg-12 col-md-12 col-xs-12 field input-group input-group-md drop">
      <?php echo $form->labelEx($model,'license_id', array('class' => 'col-md-6 col-xs-12 input-group-addon')); ?>
      <?php echo $form->dropDownList($model,'license_id',
          CHtml::listData(License::getAll(), 'id', function($license) {
              return e($license->name);
          }),
          array('class'=>'col-md-6 col-xs-12 commom-dropdpown','empty' => Yii::t('app', 'Others'))); ?>
      <?php echo $form->error($model,'license_id'); ?>
    </div>
    <div class="col-lg-12 col-md-12 col-xs-12 field input-group input-group-md">
      <?php echo $form->labelEx($model, 'licenseother', array('class' => 'col-md-6 col-xs-12 input-group-addon')); ?>
      <?php echo $form->textField($model, 'licenseother', array('class' => 'type-text form-control', 'maxlength' => 256)); ?>
      <?php echo $form->error($model, 'licenseother'); ?>
    </div>
    <?php endif; */ ?>
    </div>
</fieldset>
<fieldset>
    <div class="row">
        <div class="submit">
            <div class="col-md-9 col-sm-6">
              <?php if ($model->isNewRecord) {
                  echo CHtml::linkButton(Yii::t('app', 'Cancel'),
                    array('class'       => 'btn btn-link btn-cancel',
                          'data-action' => 'clear'));
              } else {
                  echo CHtml::linkButton(Yii::t('app', 'Cancel'),
                    array('class'       => 'btn btn-link btn-cancel',
                          'data-action' => 'view',
                          'data-target' => '/project/view',
                          'data-id'     => e($model->id)));
              } ?>
            </div>
            <div class="col-md-3 col-sm-6">
              <?php if ($model->isNewRecord) {
                  echo CHtml::submitButton(Yii::t('app', 'Create'),
                    array('class'       => 'btn btn-success btn-create',
                          'data-action' => 'create',
                          'data-target' => '/project/create'));
              } else {
                  echo CHtml::submitButton(Yii::t('app', 'Save'),
                    array('class'       => 'btn btn-success btn-create',
                          'data-action' => 'update',
                          'data-target' => '/project/update',
                          'data-id'     => e($model->id)));
              } ?>
            </div>
        </div>
    </div>
</fieldset>

<?php $this->endWidget(); ?>

