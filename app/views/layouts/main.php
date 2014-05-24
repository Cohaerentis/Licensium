<?php
  // Yii::app()->bootstrap->register();
  Yii::app()->assets->registerCss();
  Yii::app()->assets->registerScripts();
  $shiv  = 'html5shiv-3.7.0';
  $shiv .= YII_DEBUG ? '.js' : '.min.js';
  $respond  = 'respond-1.3.0';
  $respond .= YII_DEBUG ? '.js' : '.min.js';

  $flashMessages = Yii::app()->user->getFlashes(true);

  $section = array('label' => 'Home');
  $menuitems = array(
    // array('label' => Yii::t('app', 'Profile'),    'url' => 'user'),
    array('label' => Yii::t('app', 'Projects'),   'url' => 'project'),
  );
  $currentaction = Yii::app()->urlManager->parseUrl(Yii::app()->request);
  $parts = explode('/', $currentaction);
  $currentitem = '';
  if (!empty($parts[0])) $currentitem .= $parts[0];
  if (!empty($parts[1])) $currentitem .= '/'. $parts[1];

  $name = '';
  $login = array();
  $signup = array();
  if (Yii::app()->user->isGuest) {
    $login = array('class' => 'login', 'label' => Yii::t('app', 'Login'), 'url' => 'user/login');
    $signup = array('class' => 'signup', 'label' => Yii::t('app', 'Signup'), 'url' => 'user/signup');
  } else {
    $name = Yii::app()->user->firstname . ' ' . Yii::app()->user->lastname;
    $login = array('class' => 'loggedin', 'label' => $name, 'url' => 'user');
    $signup = array('class' => 'logout', 'label' => '<i class="glyphicon glyphicon-off "></i>', 'url' => 'user/logout');
  }

  $languages = array(
    'es' => array('label' => 'Español', 'url' => '?lang=es'),
    'en' => array('label' => 'English', 'url' => '?lang=en'),
  );
  $currentlang = 'es';

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
<body>
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
            <?php foreach ($menuitems as $item): ?>
              <li <?php if ($currentitem == $item['url']) echo 'class="active"'; ?>>
                <a href="<?php echo baseUrl($item['url']); ?>">
                  <?php echo $item['label']; ?>
                </a>
              </li>
            <?php endforeach ?>
          </ul>
          <div class="row userbox">
            <div class="col-lg-12 col-md-12 col-xs-12 log loginuser">
              <div class="<?php echo $login['class']; ?>">
                <a href="<?php echo baseUrl($login['url']); ?>">
                  <?php echo $login['label']; ?>
                </a>
              </div>
              <?php if (!empty($signup)) : ?>
                <div class="<?php echo $signup['class']; ?>">
                  <a href="<?php echo baseUrl($signup['url']); ?>">
                    <?php echo $signup['label']; ?>
                  </a>
                </div>
              <?php endif; ?>
            </div>
          </div><!-- /.login-->
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </header>

  <ol class="breadcrumb">
      <li><a href="<?php echo baseUrl(); ?>">Home</a></li>
      <li class="active">Proyectos</li>
  </ol>

  <?php if ($flashMessages) : ?>
  <div class="container">
      <?php foreach($flashMessages as $key => $message) : ?>
          <div class="alert alert-<?php echo $key; ?> alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $message; ?>
          </div>
      <?php endforeach; ?>
  </div>
  <?php endif; ?>

  <main class="wrap">
    <?php echo $content; ?>
  </main>

  <footer>
    <div class="footer">
      <p>&copy; Opencodex 2014</p>
    </div>
  </footer>

  </body>
</html>

