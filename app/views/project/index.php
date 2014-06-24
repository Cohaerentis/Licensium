<?php
/* @var $this ProjectController */
/* @var $projects Project list for current loggedin user */

// If selected not defined, define to none
if (empty($selected)) $selected = 0;

$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('app', 'Projects');

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
if (!empty($current)) {
  $this->breadcrumbs = array(
    Yii::t('app', 'Projects')   => '/project',
  );
} else {
  $this->breadcrumbs = array();
}

?>
<div class="project-index-wrapper common-index-wrapper">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="page-title">
                <h2 class="section-title"><?php echo Yii::t('app', 'My projects'); ?></h2>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="crud" <?php if (!empty($current)) : ?> data-current="<?php echo e($current->id); ?>" <?php endif; ?>>
              <div class="visible-xs mobile-submenu">
                <ul class="nav navbar-nav">
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="project-selected">
                          <?php if (!empty($current)): ?>
                            <i class="glyphicon glyphicon-tasks project-selected <?php echo Compatible::statusClass($current->compatibility()['status']); ?>"></i>
                              <?php echo truncate(e($item->name)); ?>
                          <?php else : ?>
                            <?php echo Yii::t('app', 'Select a project'); ?>
                          <?php endif; ?>
                        </span>
                    </a>
                    <?php $this->renderPartial('list', array('projects' => $projects,
                                               'class' => 'dropdown-menu', 'selected' => $selected)); ?>
                  </li>
                </ul>
              </div>
              <div class="crud-row">
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <div class="main-button-options">
                            <button class="btn btn-success crud-btn crud-btn-create" data-action="new" data-target="/project/create">
                                <?php echo Yii::t('app', 'Create'); ?>
                            </button>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="row main-button-options edition-buttons">
                        <div class="col-sm-6 col-xs-6">
                            <button class="<?php echo $hide; ?> crud-btn crud-btn-edit edit input-group-addon" data-action="edit" data-target="/project/update">
                              <?php echo Yii::t('app', 'Edit'); ?>
                            </button>
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <button class="<?php echo $hide; ?> crud-btn crud-btn-edit delete input-group-addon" data-action="confirm" data-target="/project/confirm"
                              data-confirm-action="delete" data-confirm-target="/project/delete"
                              data-confirm-title="<?php echo Yii::t('app', 'You are about to delete forever one of your projects.'); ?>"
                              data-confirm-heading="<?php echo Yii::t('app', "You've been warned but even so you want to delete it, go ahead!"); ?>">
                              <?php echo Yii::t('app', 'Delete'); ?>
                            </button>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="clearfix content-wrapper wrapper-list">
                  <div class="col-md-6 col-sm-6 hidden-xs">
                    <?php $this->renderPartial('list', array('class' => 'projects-list', 'projects' => $projects, 'selected' => $selected)); ?>
                  </div>
                  <div class="col-md-6 col-sm-6">
                    <div class="edit-form">
                        <div class="crud-container">
                          <?php if (!empty($selected) && !empty($current))
                            $this->renderPartial('view', array('model' => $current));
                          ?>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php $this->widget('application.widgets.ConfirmModal'); ?>
            </div>
        </div>
    </div>
</div>

