<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('app', 'Cookies policy');
$this->breadcrumbs = array();
?>
<article class="policy-wrapper">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="page-title">
                <h2><?php echo Yii::t('app', 'Cookies policy');?> <i class="glyphicon glyphicon-info-sign"></i></h2>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="policy-text">
                <div>
                    <h3><?php echo Yii::t('app', 'What are cookies?') ; ?></h3>
                </div>
                <p><?php echo Yii::t('app', 'A cookie is a text-only string of information that www.licensium.opencodex.es transfers to the cookie file of the browser on your computer’s hard disk.') ; ?></p>
                <p><?php echo Yii::t('app', 'There are three main types of cookies:'); ?></p>
                <ul>
                    <li><?php echo Yii::t('app', 'To make the website work properly for you and to enable you to make use of the services we provide.'); ?></li>
                    <li><?php echo Yii::t('app', 'To remember your preferences and make the site easier for you to use.'); ?></li>
                    <li><?php echo Yii::t('app', 'To collect information about how you use our website which is then anonymised and used to help us improve our services – cookies for this purpose are often described as analytical cookies.'); ?></li>
                </ul>
                <p>
                    <?php echo Yii::t('app', 'Cookies do not collect information such as email, username, telephone, etc.'); ?>
                    <?php echo Yii::t('app', 'Cookies may store the network ip address of the domain you are comming from.'); ?>
                    <?php echo Yii::t('app', 'An ip address is a number that identifies a device (computer, tablet, mobile) in internet.'); ?>
                    <?php echo Yii::t('app', 'That number is given by the Internet Provider (Movistar, Jazztel, Orange) to the user.'); ?>
                </p>
                <p>
                    <?php echo Yii::t('app', 'We do not use the ip address to identify users.'); ?>
                    <?php echo Yii::t('app', 'We use the ip address to registrer the activity of the user browser activity in our site.'); ?>
                </p>
                <div>
                    <h3><?php echo Yii::t('app', 'Here you have the cookies that we use in our site'); ?></h3>
                </div>
                <p>
                    <?php echo Yii::t('app', 'Users must accept our cookies before browe.'); ?>
                    <?php echo Yii::t('app', 'Users can also configure the web browser to not accept cookies although this might affect the right performance of the site.'); ?>
                </p>
                <ul>
                     <li>
                        <strong>PHPSESSID: </strong>
                        <?php echo Yii::t('app', 'These cookies store temporaly information to enable site functionality.'); ?>
                        <?php echo Yii::t('app', 'They are automatically deleted when you close your browser.'); ?>
                    </li>
                    <li>
                        <strong>_utma: </strong>
                        <?php echo Yii::t('app', 'is a persistent cookie which expires in 2 years from the last update.'); ?>
                        <?php echo Yii::t('app', 'It is used to track first visit, last visit, current visit, and number of visits.'); ?>
                        <?php echo Yii::t('app', 'The content of this cookie value is separated by a dot, and stores domain hash, random ID, time of first visit, time of last visit, time of current visit and session counter.'); ?>
                    </li>
                    <li>
                        <strong>_utmb: </strong>
                        <?php echo Yii::t('app', 'They are automatically deleted when you close your browser.'); ?>
                        <?php echo Yii::t('app', 'The content of the cookie include domain hash, pageview, number of outbound link click counting down from 10, and current time stamp.'); ?>

                    </li>
                    <li>
                        <strong>_utmc: </strong>
                        <?php echo Yii::t('app', 'used to track session status but it is no longer used.'); ?>
                        <?php echo Yii::t('app', 'The value contained domain hash.'); ?>
                    </li>
                    <li>
                        <strong>_utmz: </strong>
                        <?php echo Yii::t('app', 'keeps track of entry point into your website storing traffic source, medium, campaign, and search term used to land on your website.'); ?>
                        <?php echo Yii::t('app', 'The cookie value inclue Domain hash, current timestamp, session count, and campaign information.'); ?>
                        <?php echo Yii::t('app', 'The cookie is updated with each page view, and expires in 6 months from last update.'); ?>
                    </li>
                </ul>
                <div>
                    <h3><?php echo Yii::t('app', 'How do I unistall, block or delete cookies?'); ?></h3>
                </div>
                <p><?php echo Yii::t('app', 'You can delete cookies placed in your browser in any moment.'); ?></p>
                <p><?php echo Yii::t('app', 'Here is how you have to do it:'); ?></p>
                <ul>
                    <li>
                        <h4><?php echo Yii::t('app', 'Firefox'); ?></h4>
                        <ul>
                            <li><?php echo Yii::t('app', 'Go to Tools in the menu bar'); ?></li>
                            <li><?php echo Yii::t('app', 'Click on Options'); ?></li>
                            <li><?php echo Yii::t('app', 'Click on the Privacy tab'); ?></li>
                            <li><?php echo Yii::t('app', 'Click on "Clear Now"'); ?></li>
                            <li><?php echo Yii::t('app', 'Select "Cookies"'); ?></li>
                            <li><?php echo Yii::t('app', 'Click on "Clear Private Data Now"'); ?></li>
                        </ul>
                    </li>
                    <li>
                        <h4><?php echo Yii::t('app', 'Google Chrome'); ?></h4>
                        <ul>
                            <li><?php echo Yii::t('app', 'Click on the spanner icon in the top right of the browser'); ?></li>
                            <li><?php echo Yii::t('app', 'Click on Options'); ?></li>
                            <li><?php echo Yii::t('app', 'Click on the "Content settings" button in the Privacy section'); ?></li>
                            <li><?php echo Yii::t('app', 'Select Click on the "Clear browsing data" button'); ?></li>
                        </ul>
                    </li>
                    <li>
                        <h4><?php echo Yii::t('app', 'Safari'); ?></h4>
                        <ul>
                            <li><?php echo Yii::t('app', 'Go to the Safari menu'); ?></li>
                            <li><?php echo Yii::t('app', 'Click on the Preferences'); ?></li>
                            <li><?php echo Yii::t('app', 'Click the "Security" tab'); ?></li>
                            <li><?php echo Yii::t('app', 'Under "Accept Cookies", set it to accept, reject, or selectively accept cookies'); ?></li>
                        </ul>
                    </li>
                    <li>
                        <h4><?php echo Yii::t('app', 'Internet Explorer'); ?></h4>
                        <ul>
                            <li><?php echo Yii::t('app', 'Go to Tools in the menu bar'); ?></li>
                            <li><?php echo Yii::t('app', 'Click on Internet Options'); ?></li>
                            <li><?php echo Yii::t('app', 'Click on the General tab which should be under "Browsing History" and click "Delete"'); ?></li>
                            <li><?php echo Yii::t('app', 'Click OK and Close the screen'); ?></li>
                        </ul>
                    </li>
                </ul>
                <div>
                    <h3><?php echo Yii::t('app', 'Updates and changes in Cookies Policy'); ?></h3>
                </div>
                <p>
                    <?php echo Yii::t('app', 'We keep this Policy under regular review.'); ?>
                <p>
                    <?php echo Yii::t('app', 'We may change this Policy from time to time by updating this page in order to reflect changes in the law and/or our privacy practices.'); ?>
                    <?php echo Yii::t('app', 'We will notify you of any modified versions of this Policy that might materially affect the way we use or disclose your personal information.'); ?>
                </p>
            </div>
        </div>
    </div>
</article>