<?php
/* @var $this UserController */
/* @var $model User */
/* @var $secret Secret string generated  */

?>
<p>
    This is the email confirmation (HTML). Extraños caracteres.<br />
    TODO : Generate confirmation link and write a compresive instructions
</p>
<p>
    <strong>secret</strong> : <?php echo e($secret); ?><br />
    <strong>name</strong> : <?php echo e($model->fullName()); ?><br />
    <strong>link</strong> : <?php echo $this->createAbsoluteUrl('user/confirm', array('id' => $model->id, 'code' => e($secret))); ?><br />
</p>
