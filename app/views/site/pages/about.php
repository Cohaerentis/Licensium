<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
    'About',
);
?>
<div class="about-wrapper">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="page-title">
                <h2><?php echo Yii::t('app', 'About Us');?> <i class="glyphicon glyphicon-info-sign"></i></h2>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="about-text">
                <p>
                    <?php
                        echo Yii::t(
                            'app',
                            'Licensium has been developed by Cohaerentis, strategic consultanting based in information technologies, ' .
                            'thanks to the collaborative effort between legal area and the business technology projects management.'
                        );
                    ?>
                </p>
                <p>
                    <?php
                        echo Yii::t(
                            'app',
                            'The application comes up from the need for lawyers to be able to access the list of licenses ' .
                            'whose code has been integrated into a project development, in order to make an opinion on the licenses ' .
                            'compatibility and whether these are in line with business or private interests of our customers.'
                        );
                    ?>
                </p>
            </div>
        </div>
    </div>
</div>