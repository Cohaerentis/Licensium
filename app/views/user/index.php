<article class="user-wrapper">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12 page-title">
            <h2><?php echo Yii::t('app', 'My profile');?></h2>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="col-lg-12 col-md-12 col-xs-12 field input-group input-group-md">
                    <div class="row">
                      <div class="col-lg-4 input-group-addon"><?php echo e($model->getAttributeLabel('email')); ?></div>
                      <div class="col-lg-8 form-control"><?php echo e($model->email); ?></div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-xs-12 field input-group input-group-md">
                    <div class="row">
                      <div class="col-lg-4 input-group-addon"><?php echo e($model->getAttributeLabel('firstname')); ?></div>
                      <div class="col-lg-8 form-control"><?php echo e($model->firstname); ?></div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-xs-12 field input-group input-group-md">
                    <div class="row">
                      <div class="col-lg-4 input-group-addon"><?php echo e($model->getAttributeLabel('lastname')); ?></div>
                      <div class="col-lg-8 form-control"><?php echo e($model->lastname); ?></div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-xs-12 field input-group input-group-md">
                    <div class="row">
                      <div class="col-lg-4 input-group-addon"><?php echo e($model->getAttributeLabel('company')); ?></div>
                      <div class="col-lg-8 form-control"><?php echo e($model->company); ?></div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-xs-12 field input-group input-group-md">
                    <div class="row">
                      <div class="col-lg-4 input-group-addon"><?php echo e($model->getAttributeLabel('registerdate')); ?></div>
                      <div class="col-lg-8 form-control"><?php echo e($model->registerDatePrint()); ?></div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-xs-12 field control-btn">
                    <?php echo CHtml::button(Yii::t('app', 'Edit my profile'), 
                        array('class'  => 'btn btn-success', 'submit' => array('/user/update')));
                    ?>
                    <?php echo CHtml::button(Yii::t('app', 'Change password'), 
                        array('class'  => 'btn btn-success', 'submit' => array('/user/password')));
                    ?>
                </div>
        </div>
    </div>
</article>