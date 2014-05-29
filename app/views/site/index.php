<?php
/* @var $this SiteController */

    // TODO : Nothing to show by now ;)

?>
<article class="home-wrapper">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12 home">
            <h1>Licensium</h1>
            <p class="home-text"><?php echo Yii::t('app', 'Licensium  is a tool for preparing inventories of open source licenses, 
            in order to control their compatibility and their requirements.');?></p>
            <p class="home-text"><?php echo Yii::t('app', 'With Licensium you will be able to:');?></p>
            <div class="row items">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item"><i class="glyphicon glyphicon-chevron-right"></i><?php echo Yii::t('app', 'Keep track of the licenses being used in your code');?></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item"><i class="glyphicon glyphicon-chevron-right"></i><?php echo Yii::t('app', 'Identify compatibility of licenses');?></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item"><i class="glyphicon glyphicon-chevron-right"></i><?php echo Yii::t('app', 'Give access to other professionals to that inventory');?></div>
                <?php if (Yii::app()->user->isGuest): ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 home-buttons">
                        <?php echo CHtml::Button(Yii::t('app', 'Login'),
                            array('class'       => 'btn btn-success', 'submit' => array('/user/login')));
                        ?>
                        <?php echo CHtml::Button(Yii::t('app', 'Signup'),
                            array('class'       => 'btn btn-success', 'submit' => array('/user/signup')));
                        ?>
                    </div>
                <?php endif;?>
            </div>
        </div>
      </div>
  </article>
