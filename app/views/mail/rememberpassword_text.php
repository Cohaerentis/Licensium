<?php
/* @var $this UserController */
/* @var $model User */
/* @var $secret Secret string generated  */

?>
This is the remember password email (TEXT). Extraños caracteres.
TODO : Generate confirmation link and write a compresive instructions

SECRET : <?php echo e($secret) . "\n"; ?>
NAME   : <?php echo e($model->fullName()) . "\n"; ?>
LINK   : <?php echo $this->createAbsoluteUrl('user/password', array('id' => $model->id, 'code' => e($secret))) . "\n"; ?>
