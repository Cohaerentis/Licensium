<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('app', 'Registry Form');
$this->breadcrumbs = array();

?>
  <div class="signup-wrapper">
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
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="page-title">
                <h2><?php echo Yii::t('app', 'Registry Form');?></h2>
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
                                    <?php echo $form->textField($model, 'email', array('class'=> 'type-text form-control', 'maxlength' => 100, 'placeholder' => Yii::t('app', 'your email address') )); ?>
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
                                    <?php echo $form->passwordField($model, 'password', array('class' => 'type-text form-control', 'maxlength' => 100, 'placeholder' => Yii::t('app', 'your favorite password'))); ?>
                                    <?php echo $form->error($model, 'password'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="field input-group input-group-md">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <?php echo $form->labelEx($model, 'firstname', array('class' => 'input-group-addon')); ?>
                                    <?php echo $form->textField($model, 'firstname', array('class' => 'type-text form-control', 'maxlength' => 100, 'placeholder' => Yii::t('app', 'your name'))); ?>
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
                                    <?php echo $form->textField($model, 'lastname', array('class' => 'type-text form-control', 'maxlength' => 100, 'placeholder' => Yii::t('app', 'your last name'))); ?>
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
                                    <?php echo $form->textField($model, 'company', array('class' => 'type-text form-control', 'maxlength' => 100, 'placeholder' => Yii::t('app', 'the company you are developing software'))); ?>
                                    <?php echo $form->error($model, 'company'); ?>
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
                            <?php echo CHtml::submitButton(Yii::t('app', 'Signup'),
                                array('class'       => 'btn btn-success',
                                      'id'          => 'btn-signup'));
                            ?>
                            <div class="privacy">
                                <?php /* <input type="checkbox" id="check" name="check"> */ ?>
                                <?php echo $form->error($model, 'privacy'); ?>
                                <?php echo $form->checkBox($model, 'privacy'); ?>
                                <a href="/site/page/view/privacy-policy" target="_blank"><?php echo Yii::t('app', 'Privacy policy'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <?php $this->endWidget(); ?>
  </div>
<?php $this->widget('application.widgets.CookiesWarning'); ?>