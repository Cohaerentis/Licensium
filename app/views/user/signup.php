<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm  */

?>
  <article class="signup-wrapper">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'signup-form',
        'htmlOptions' => array('class' => 'general-form'),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>
      <fieldset class="row">
        <div class="col-md-12 field">
          <?php echo $form->labelEx($model, 'email'); ?>
          <?php echo $form->textField($model, 'email', array('class' => 'type-text', 'maxlength' => 100)); ?>
          <?php echo $form->error($model, 'email'); ?>
        </div>
        <div class="col-md-12 field">
          <?php echo $form->labelEx($model, 'password'); ?>
          <?php echo $form->passwordField($model, 'password', array('class' => 'type-text', 'maxlength' => 100)); ?>
          <?php echo $form->error($model, 'password'); ?>
        </div>
        <div class="col-md-12 field">
          <?php echo $form->labelEx($model, 'firstname'); ?>
          <?php echo $form->textField($model, 'firstname', array('class' => 'type-text', 'maxlength' => 100)); ?>
          <?php echo $form->error($model, 'firstname'); ?>
        </div>
        <div class="col-md-12 field">
          <?php echo $form->labelEx($model, 'lastname'); ?>
          <?php echo $form->textField($model, 'lastname', array('class' => 'type-text', 'maxlength' => 100)); ?>
          <?php echo $form->error($model, 'lastname'); ?>
        </div>
        <div class="col-md-12 field">
          <?php echo $form->labelEx($model, 'company'); ?>
          <?php echo $form->textField($model, 'company', array('class' => 'type-text', 'maxlength' => 100)); ?>
          <?php echo $form->error($model, 'company'); ?>
        </div>
      </fieldset>
      <fieldset class="row submit">
        <?php echo CHtml::submitButton(Yii::t('app', 'Signup'),
            array('class'       => 'btn btn-success'));
        ?>
      </fieldset>
    <?php $this->endWidget(); ?>
  </article>
