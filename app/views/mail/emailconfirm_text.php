<?php
/* @var $this UserController */
/* @var $model User */
/* @var $secret Secret string generated  */

?>
<?php echo Yii::t('app', 'Hi');?>, <?php echo e($model->fullName()). "\n\n"; ?>.
<?php echo Yii::t('app', 'You have just created a new account at Licensium.'). "\n"; ?>
<?php echo Yii::t('app', 'To confirm this and activate it, go to the following web address:'). "\n\n"; ?>
<?php echo $this->createAbsoluteUrl('user/confirm', array('id' => $model->id, 'code' => e($secret))). "\n\n";  ?>
<?php echo Yii::t('app', 'In most mail programs, this should appear as a blue link which you can just click on. If that does not work, then cut and paste the address into the address line at the top of your web browser window.'). "\n\n"; ?>
<?php echo Yii::t('app', 'If you need help, please contact the site administrator');?>.