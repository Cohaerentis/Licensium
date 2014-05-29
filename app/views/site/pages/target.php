<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
    'About',
);
?>
<article class="target-wrapper">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12 page-title">
            <h2><?php echo Yii::t('app', 'Goal');?> <i class="glyphicon "></i></h2>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12 target-text">
            <p>
                <?php
                    echo Yii::t(
                        'app',
                        'One of the biggest problems when we perform a compatibility license diagnostic consultancy is access to a clear
                         and detailed list of licenses whose code has been used in development.'
                    );
                ?>
            </p>
            <p>
                <?php
                    echo Yii::t(
                        'app',
                        'Therefore we always recommend as a "good practice" to be performed by the companies keep an inventory of 
                        such licenses attaching, if possible, the contents thereof by the time the code is linked or integrated.'
                    );
                ?>
            </p>
            <p>
                <?php
                    echo Yii::t(
                        'app',
                        'While this is a task that can be performed easily with the most popular office tools, we wanted to go one 
                        step foward and developed a tool that make this work to programmers easier, adding value to the inventory. 
                        Licensium has the following features:'
                    );
                ?>
            </p>
            <br />
            <p>
                <i class="glyphicon glyphicon-arrow-right"></i>
                <?php
                    echo Yii::t(
                        'app',
                        'Maintain an inventory of licenses used'
                    );
                ?>
            </p>
            <p>
                <i class="glyphicon glyphicon-arrow-right"></i>
                <?php
                    echo Yii::t(
                        'app',
                        'Project and licenses editing'
                    );
                ?>
            </p>
            <p>
                <i class="glyphicon glyphicon-arrow-right"></i>
                <?php
                    echo Yii::t(
                        'app',
                        'Share projects with other consultants'
                    );
                ?>
            </p>
            <p>
                <i class="glyphicon glyphicon-arrow-right"></i>
                <?php
                    echo Yii::t(
                        'app',
                        'Add licenses as attached files'
                    );
                ?>
            </p>
            <p>
                <i class="glyphicon glyphicon-arrow-right"></i>
                <?php
                    echo Yii::t(
                        'app',
                        'Link the source code used to the license model'
                    );
                ?>
            </p>
            <p>
                <i class="glyphicon glyphicon-arrow-right"></i>
                <?php
                    echo Yii::t(
                        'app',
                        'Provide the posibility of checking compatibilty between licenses being used'
                    );
                ?>
            </p>
            <p>
                <i class="glyphicon glyphicon-arrow-right"></i>
                <?php
                    echo Yii::t(
                        'app',
                        'Provide a development license choice tool through three criteria: licenses compatibilty, geographical scope and commercial interests.'
                    );
                ?>
            </p>
        </div>
    </div>
</article>
