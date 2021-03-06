<?php

$cookies_warning = !isset(Yii::app()->request->cookies['licensium_cookies_acknowlegde']);
/* Done in JS
if ($cookies_warning) {
  Yii::app()->request->cookies['licensium_cookies_acknowlegde'] =
    new CHttpCookie('licensium_cookies_acknowlegde', 'yes', array(
      'expire' => time() + (10 * 365 * 24 * 3600),
    ));
} */
// Yii::app()->bootstrap->register();
Yii::app()->assets->registerCss();
Yii::app()->assets->registerScripts();
// GoogleAnalytics : This only inyect JS garun function. It must be called in order to load
Yii::app()->assets->registerGoogleAnalytics();

$shiv  = 'html5shiv-3.7.0';
$shiv .= YII_DEBUG ? '.js' : '.min.js';
$respond  = 'respond-1.3.0';
$respond .= YII_DEBUG ? '.js' : '.min.js';

$flashMessages = Yii::app()->user->getFlashes(true);

$section = array('label' => 'Home');
$menuitems_login = array(
    // array('label' => Yii::t('app', 'Profile'),    'url' => 'user'),
  array('label' => Yii::t('app', 'Projects'),   'url' => 'project'),
  );
$menuitems_logout = array(
  array('label' => Yii::t('app', 'About us'),  'icon' => 'bullhorn',   'url' => '/site/page/view/about'),
  array('label' => Yii::t('app', 'Goal'),      'icon' => 'screenshot',         'url' => '/site/page/view/goal'),
  array('label' => Yii::t('app', 'Contact'),   'icon' => 'map-marker',    'url' => 'http://www.cohaerentis.com/datos-de-contacto'),

  );
$main_menu = array();
$currentaction = Yii::app()->urlManager->parseUrl(Yii::app()->request);
$parts = explode('/', $currentaction);
$currentitem = '';
if (!empty($parts[0])) $currentitem .= $parts[0];
if (!empty($parts[1])) $currentitem .= '/'. $parts[1];

$name = '';
$login = array();
$signup = array();
$log_class = '';
if (Yii::app()->user->isGuest) {
  $login = array('class' => 'login', 'label' => Yii::t('app', 'Login'), 'url' => 'user/login', 'id' => 'link-login');
  $signup = array('class' => 'signup', 'label' => Yii::t('app', 'Signup'), 'url' => 'user/signup', 'id' => 'link-signup');
  $log_class = 'log_class';
  $main_menu = $menuitems_logout;
  $footer_col = 'col-lg-6 col-md-8 col-sm-6 col-xs-12';
  $footer_left = 'col-lg-6 col-md-4 col-sm-6 col-xs-12';
  $footer_left_down = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
  $footer_logo = 'footer-logo-logout';
} else {
  $name = trim(Yii::app()->user->firstname . ' ' . Yii::app()->user->lastname);
  if (empty($name)) $name = Yii::app()->user->email;
  $login = array('class' => 'loggedin', 'label' => $name, 'url' => 'user', 'id' => 'link-profile');
  $signup = array('class' => 'logout', 'label' => '<i class="glyphicon glyphicon-off "></i>', 'url' => 'user/logout', 'id' => 'link-logout');
  $main_menu = $menuitems_login;
  $footer_col = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
  $footer_left = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
  $footer_left_down = 'col-lg-6 col-md-6 col-sm-12 col-xs-12';
  $footer_logo = 'footer-logo-login';
}

$languages = !empty(Yii::app()->params['languages']) ? Yii::app()->params['languages'] : array();
$bodyclass = '';
if ($cookies_warning) {
  $bodyclass = 'cookies-warning';
}

?>
<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    <script src="<?php echo Yii::app()->assets->url . '/' . $shiv; ?>"></script>
    <script src="<?php echo Yii::app()->assets->url . '/' . $respond; ?>"></script>
    <![endif]-->

    <title><?php echo e($this->pageTitle); ?></title>
  </head>
  <body class="<?php echo $bodyclass; ?>">
    <header>
      <nav class="navbar navbar-default" role="navigation">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo baseUrl(); ?>">
              <img src="/img/logo.png"/>
              <span class="logo-title"><?php echo Yii::app()->name; ?></span>
            </a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <?php foreach ($main_menu as $item): ?>
                <li <?php if ($currentitem == $item['url']) echo 'class="active"'; ?>>
                  <a href="<?php echo baseUrl($item['url']); ?>">
                    <?php echo $item['label']; ?>
                  </a>
                </li>
              <?php endforeach ?>
            </ul>
            <div class="userbox">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12">
                  <div class="language">
                    <?php foreach ($languages as $code => $language):
                    $langclass = array('single-language');
                    if (Yii::app()->language == $code) {
                      $langclass[] = 'current';
                    }
                    ?>
                    <a href="<?php echo $language['url']; ?>">
                      <div class="<?php echo implode(' ', $langclass); ?>">
                        <?php echo $language['label']; ?>
                      </div>
                    </a>
                  <?php endforeach; ?>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-xs-12">
                <div class=" log loginuser <?php echo $log_class;?>">
                  <div class="<?php echo $login['class']; ?>">
                    <a id="<?php echo $login['id']; ?>" href="<?php echo baseUrl($login['url']); ?>">
                      <?php echo $login['label']; ?>
                    </a>
                  </div>
                  <?php if (!empty($signup)) : ?>
                    <div class="<?php echo $signup['class']; ?>">
                      <a id="<?php echo $signup['id']; ?>" href="<?php echo baseUrl($signup['url']); ?>">
                        <?php echo $signup['label']; ?>
                      </a>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div><!-- /.login-->
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </header>

  <?php $this->widget('application.widgets.Breadcrumbs', array(
    'links' => $this->breadcrumbs,
    ));
  /*
  <ol class="breadcrumb">
      <li><a href="<?php echo baseUrl(); ?>">Home</a></li>
      <li class="active">Proyectos</li>
  </ol>
  */ ?><!-- breadcrumbs -->


  <main class="container main-container">
    <?php if ($flashMessages) : ?>
      <?php foreach($flashMessages as $key => $message) : ?>
        <div class="alert alert-<?php echo $key; ?> alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <?php echo $message; ?>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
    <?php if ( (!Yii::app()->user->isGuest) && (Yii::app()->user->getState('confirmed') == 0) ) : ?>
        <div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <?php
            $resendlink = CHtml::link(Yii::t('app', 'Resend'),
                                      Yii::app()->createUrl('user/resend', array('id' => e(Yii::app()->user->id) )),
                                      array('id' => 'link-confirm-resend') );
            echo Yii::t('app', 'Your email is not confirmed yet! {resend} email confirmation',
                        array('{resend}' => $resendlink)); ?>
        </div>
    <?php endif; ?>
    <?php echo $content; ?>
  </main>

  <footer>
    <div class="footer">
      <div class="container">
        <div class="row">
          <div class="<?php echo $footer_left; ?>">
            <div class="row">
              <div class="<?php echo $footer_left_down; ?>">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <div class="footer-left">
                    <a target="_blank" href ='https://github.com/Teachnova/Licensium/blob/master/LICENSE'>
                      <p><?php echo Yii::t('app', 'License'); ?></p>
                      <i class="glyphicon glyphicon-bookmark"></i>
                    </a>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <div class="footer-left">
                    <a target="_blank" href ='https://github.com/Teachnova/Licensium/'>
                      <p><?php echo Yii::t('app', 'Source code'); ?></p>
                      <i class="glyphicon glyphicon-link"></i>
                    </a>
                  </div>
                </div>
              </div>
              <div class="<?php echo $footer_left_down; ?>">
                <?php if (Yii::app()->user->isGuest) :?>
                <?php else :?>
                  <div class="row">
                    <div class="footer-links">
                      <?php foreach ($menuitems_logout as $item): ?>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                          <a href="<?php echo baseUrl($item['url']); ?>">
                            <p><?php echo $item['label']; ?></p>
                            <i class="glyphicon glyphicon-<?php echo $item['icon'] ; ?> "></i>
                          </a>
                        </div>
                      <?php endforeach ?>
                    </div>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="<?php echo $footer_col;?>">
            <div class="<?php echo $footer_logo; ?>">
              <a href="http://www.cohaerentis.com"><img src ="/img/cohaerentis.png"/></a>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="footer-bottom">
              <p><?php echo Yii::t('app', 'Licensium is a Cohaerentis Consultores product, strategic business consulting for open business models. &copy; 2014')  ?></p>
              <div class="legal">
                  <a href="/site/page/view/legal"><?php echo Yii::t('app', 'Disclaimer & Conditions of Use');?></a>
                  &nbsp;&nbsp;|&nbsp;&nbsp;
                  <a href="/site/page/view/privacy-policy"><?php echo Yii::t('app', 'Privacy Policy');?></a>
                  &nbsp;&nbsp;|&nbsp;&nbsp;
                  <a href="/site/page/view/cookies-policy"><?php echo Yii::t('app', 'Cookies policy');?></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
</body>
</html>

