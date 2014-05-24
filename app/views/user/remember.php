<?php
/* @var $this UserController */
/* @var $model RememberForm */
/* @var $form CActiveForm  */

?>
  <article class="remember-wrapper">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'remember-form',
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
      </fieldset>
      <fieldset class="row submit">
        <?php echo CHtml::submitButton(Yii::t('app', 'Remember'),
            array('class'       => 'btn'));
        ?>
      </fieldset>
    <?php $this->endWidget(); ?>
  </article>
