<p><strong>Perfil del usuario</strong></p>
<p>
    <strong><?php echo e($model->getAttributeLabel('id')); ?></strong> :
    <?php echo e($model->id); ?>
</p>
<p>
    <strong><?php echo e($model->getAttributeLabel('email')); ?></strong> :
    <?php echo e($model->email); ?>
</p>
<?php /*
<p>
    <strong><?php echo e($model->getAttributeLabel('privileges')); ?></strong> :
    <?php echo e($model->privileges); ?>
</p>
*/ ?>
<p>
    <strong><?php echo e($model->getAttributeLabel('firstname')); ?></strong> :
    <?php echo e($model->firstname); ?>
</p>
<p>
    <strong><?php echo e($model->getAttributeLabel('lastname')); ?></strong> :
    <?php echo e($model->lastname); ?>
</p>
<p>
    <strong><?php echo e($model->getAttributeLabel('company')); ?></strong> :
    <?php echo e($model->company); ?>
</p>
<p>
    <strong><?php echo e($model->getAttributeLabel('registerdate')); ?></strong> :
    <?php echo e($model->registerDatePrint()); ?>
</p>

<p>
    <a href="/user/update">Editar perfil</a> -
    <a href="/user/password">Cambiar contraseña</a>
</p>