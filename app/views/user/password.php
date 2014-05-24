<?php
/* @var $this UserController */
/* @var $model PasswordForm */
/* @var $form CActiveForm  */

?>
  <article class="password-wrapper">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'password-form',
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
          <?php echo $form->labelEx($model, 'password'); ?>
          <?php echo $form->passwordField($model, 'password', array('class' => 'type-text', 'maxlength' => 100)); ?>
          <?php echo $form->error($model, 'password'); ?>
        </div>
        <div class="col-md-12 field">
          <?php echo $form->labelEx($model, 'repassword'); ?>
          <?php echo $form->passwordField($model, 'repassword', array('class' => 'type-text', 'maxlength' => 100)); ?>
          <?php echo $form->error($model, 'repassword'); ?>
        </div>
      </fieldset>
      <fieldset class="row submit">
        <?php echo CHtml::submitButton(Yii::t('app', 'Change'),
            array('class'       => 'btn'));
        ?>
      </fieldset>
    <?php $this->endWidget(); ?>
  </article>
