<?php
/* @var $this UserController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('app', 'Login');
$this->breadcrumbs = array();

?>
  <div class="login-wrapper">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
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
              <h2><?php echo Yii::t('app', 'Login');?></h2>
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
                                    <?php echo $form->textField($model, 'email', array('class' => 'type-text form-control', 'maxlength' => 100, 'placeholder' => 'email')); ?>
                                    <?php echo $form->error($model, 'email'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="field input-group input-group-md">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <?php echo $form->labelEx($model, 'password', array('class' => 'input-group-addon')); ?>
                                    <?php echo $form->passwordField($model, 'password', array('class' => 'type-text form-control', 'maxlength' => 100, 'placeholder' => 'password')); ?>
                                    <?php echo $form->error($model, 'password'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="row">
                    <div class="submit">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <?php echo CHtml::submitButton(Yii::t('app', 'Login'),
                                array('class'       => 'btn btn-success')); ?>
                            <?php echo CHtml::linkButton(Yii::t('app', 'Remember password'),
                                array('class'       => 'btn btn-link remember',
                                      'href'        => '/user/remember')); ?>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <?php $this->endWidget(); ?>
  </div>
<?php $this->widget('application.widgets.CookiesWarning'); ?>