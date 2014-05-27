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
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12 page-title">
            <h2><?php echo Yii::t('app', 'Forgot your password');?> <i class="glyphicon glyphicon-question-sign"></i></h2>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <fieldset class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 field input-group input-group-md">
                  <?php echo $form->labelEx($model, 'email', array('class' => 'col-xs-6 input-group-addon')); ?>
                  <?php echo $form->textField($model, 'email', array('class' => 'type-text form-control', 'maxlength' => 100, 'placeholder' => 'email')); ?>
                  <?php echo $form->error($model, 'email'); ?>
                </div>
            </fieldset>
            <fieldset class="row submit">
                <?php echo CHtml::submitButton(Yii::t('app', 'Remember'),
                    array('class'       => 'btn btn-success'));
                ?>
            </fieldset>
        </div>
      </div>
    <?php $this->endWidget(); ?>
  </article>
