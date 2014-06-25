<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('app', 'Privacy policy');
$this->breadcrumbs = array();
?>
<article class="policy-wrapper">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="page-title">
                <h2><?php echo Yii::t('app', 'Privacy policy');?> <i class="glyphicon glyphicon-info-sign"></i></h2>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="policy-text">
                <p><?php echo Yii::t('app', 'You can view the owner of this website and the file manager incorporating the data collected through it in our'); ?>
                    <a href="/site/page/view/legal"><?php echo Yii::t('app', 'disclaimer and terms of use'); ?></a>.
                </p>
                <div>
                    <h3><?php echo Yii::t('app', 'Data collection and processing purposes:');?></h3>
                </div>
                <p><?php echo Yii::t('app', 'The personal data that is collected through the domain');?>
                   licensium.opencodex.es
                   <?php echo Yii::t('app', 'will be processed as follows:'); ?></p>
                <p><?php echo Yii::t('app', 'To use the web application is necessary for the user to register. On the form you will be asked for personal information relating to: name, email and company to which it belongs. Those required to provide data are marked by an asterisk.');?></p>
                <p><?php echo Yii::t('app', 'The aim of treatment is to use the web application that is available to the user.');?></p>
                <p><?php echo Yii::t('app', 'The user\'s email will be used to send commercial information about the products and services of our company. Subject to the right of the user to revoke his CONSENT by the means indicated in the communication received or, in any case, writing to the following email address:');?> <a href="mailto:info@cohaerentis.com">info@cohaerentis.com</a>.</p>
                <p><?php echo Yii::t('app', 'The above personal data will be included in a file called "registered users" duly notified to the Registry of the Spanish Data Protection Agency, in compliance with the obligations under the Organic Law on Data Protection.');?></p>
                <p><?php echo Yii::t('app', 'You can view files reported by Cohaerentis SL on the website of the Spanish Data Protection Agency.');?></p>
                <div>
                    <h3><?php echo Yii::t('app', 'Data communication');?></h3>
                </div>
                <p><?php echo Yii::t('app', 'Data holder will not be communicated to third parties in any case. If for some reason necessary to communicate such data to third parties, such a case will be communicated in advance to the owner of the data, specifying the purpose of the communication and the third who will be communicated.');?></p>
                <div>
                    <h3><?php echo Yii::t('app', 'Security');?></h3>
                </div>
                <p><?php echo Yii::t('app', 'Cohaerentis S.L. has taken appropriate technical and organizational measures, in accordance with data protection legislation, to prevent the loss of personal data or misuse thereof.');?></p>
                <div>
                    <h3><?php echo Yii::t('app', 'Navigation');?></h3>
                <p><?php echo Yii::t('app', 'This web site uses the following cookies:');?></p>
                    <ul>
                        <li><?php echo Yii::t('app', 'PHP Session cookie');?></li>
                        <li><?php echo Yii::t('app', 'Google Analytics');?></li>
                        <li><?php echo Yii::t('app', 'Avoid cookies warning');?></li>
                    </ul>
                    <p>
                        <?php echo Yii::t('app', 'You can read our Cookies policy by visiting the following');?><a href="/site/page/view/cookies-policy">
                        <?php echo Yii::t('app', 'link') ?></a>.
                    </p>
                <div>
                    <h3><?php echo Yii::t('app', 'Data Controller');?></h3>
                <p><?php echo Yii::t('app', 'The data controller is Cohaerentis S. L. You can view all business details in the'); ?>
                   <a href="/site/page/view/legal"><?php echo Yii::t('app', 'disclaimer of this site'); ?></a>.
                   <?php echo Yii::t('app', 'You can exercise your rights of access, rectification, cancellation and opposition by sending an email to');?> <a href="mailto:info@cohaerentis.com">info@cohaerentis.com</a>.</p>
            </div>
        </div>
    </div>
</article>