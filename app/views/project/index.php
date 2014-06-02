<?php
/* @var $this ProjectController */
/* @var $projects Project list for current loggedin user */

// If selected not defined, define to none
if (empty($selected)) $selected = 0;


// Search for selected item
$current = null;
if (!empty($projects)) {
  foreach ($projects as $item) {
    if ($item->id == $selected) {
      $current = $item;
      break;
    }
  }
}

$hide = !empty($current) ? '' : 'hide';

?>
<article class="project-index-wrapper">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12 page-title">
            <h2 class="section-title"><?php echo Yii::t('app', 'My projects'); ?></h2>
        </div>
        <div class="col-md-6 col-sm-6 edit-form">
                    <div class="crud-container">
                      <?php if (!empty($selected) && !empty($current))
                        $this->renderPartial('view', array('model' => $current));
                      ?>
                    </div>
                  </div>
                  <div class="visible-xs mobile-submenu">
                    <ul class="nav navbar-nav">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo Yii::t('app', 'My projects'); ?></a>
                        <?php $this->renderPartial('list', array('projects' => $projects, 'class' => 'dropdown-menu', 'selected' => $selected)); ?>
                      </li>
                    </ul>
                  </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="crud" <?php if (!empty($selected)) : ?> data-current="<?php echo e($selected); ?>" <?php endif; ?>>
              <div class="row crud-row">
                <div class="col-md-6 col-sm-6 col-xs-4">
                  <div class="main-button-options">
                    <ul>
                      <li>
                        <button class="btn btn-success crud-btn crud-btn-create" data-action="new" data-target="/project/create">
                          <?php echo Yii::t('app', 'Create'); ?>
                        </button>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-8">
                  <div class="row main-button-options edition-buttons">
                    <ul>
                      <li>
                        <button class="<?php echo $hide; ?> crud-btn crud-btn-edit col-xs-6 input-group-addon" data-action="edit" data-target="/project/update">
                          <?php echo Yii::t('app', 'Edit'); ?>
                        </button>
                      </li>
                      <li>
                        <button class="<?php echo $hide; ?> crud-btn crud-btn-edit col-xs-6 input-group-addon" data-action="confirm" data-target="/project/confirm"
                          data-confirm-action="delete" data-confirm-target="/project/delete"
                          data-confirm-title="<?php echo Yii::t('app', 'Delete confirmation'); ?>"
                          data-confirm-heading="<?php echo Yii::t('app', 'Are you sure you want delete this project?'); ?>">
                          <?php echo Yii::t('app', 'Delete'); ?>
                        </button>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="clearfix content-wrapper">
                  <div class="col-md-6 col-sm-6 hidden-xs">
                    <?php $this->renderPartial('list', array('class' => 'projects-list', 'projects' => $projects, 'selected' => $selected)); ?>
                  </div>
                  <div class="col-md-6 col-sm-6 edit-form">
                    <div class="crud-container">
                      <?php if (!empty($selected) && !empty($current))
                        $this->renderPartial('view', array('model' => $current));
                      ?>
                    </div>
                  </div>
                  <div class="visible-xs mobile-submenu">
                    <ul class="nav navbar-nav">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo Yii::t('app', 'My projects'); ?></a>
                        <?php $this->renderPartial('list', array('projects' => $projects, 'class' => 'dropdown-menu', 'selected' => $selected)); ?>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <?php $this->widget('application.widgets.ConfirmModal'); ?>
            </div>
        </div>
    </div>
</article>

