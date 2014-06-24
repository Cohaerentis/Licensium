<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('app', 'Propietary license');
$this->breadcrumbs = array();

?>
<article class="license-wrapper">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="page-title">
                <h2><?php echo Yii::t('app', 'Propietary License');?> <i class="glyphicon glyphicon-info-sign"></i></h2>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="legal-text">
                <p><?php echo Yii::t('app', 'We are calling proprietary software license to a license type that does not yield any intellectual property to third parties, beyond the mere use of the program that falls under such license. Opposed to any type of license called open source. Such a license would come to be expressed in the following terms:'); ?></p>
                <ul>
                    <li><?php echo Yii::t('app', 'The licensee is granted a nonexclusive, nontransferable license to download, access and use the Software for the sole purpose of using it.'); ?></li>
                    <li><?php echo Yii::t('app', 'Licensee may not reverse engineer, decompile or disassemble all or part of the Program. Access to the source code in anyway is prohibited.'); ?></li>
                </ul>
            </div>
        </div>
    </div>
</article>
<?php $this->widget('application.widgets.CookiesWarning'); ?>