<?php
/* @var $this ModuleController */
/* @var $modules Module list for current Project */
/* @var $project Current Project */
/* @var $selected Module ID selected */

// If selected not defined, define to none
if (empty($selected)) $selected = 0;

$this->breadcrumbs = array(
  Yii::t('app', 'Projects')   => '/project',
  e($project->name)           => '/project/view/' . e($project->id),
);

// Search for selected item
$current = null;
if (!empty($modules)) {
  foreach ($modules as $item) {
    if ($item->id == $selected) {
      $current = $item;
      break;
    }
  }
}

$hide = !empty($current) ? '' : 'hide';

?>
<article class="module-index-wrapper common-index-wrapper">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12 page-title">
            <h2 class="section-title"><?php echo Yii::t('app', 'Modules integrated in ') . e($project->name); ?></h2>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
                <p>TODO : Show a project compatibility resume</p>
                <a href="#" class=" btn btn-success right print">
                    <i class="glyphicon glyphicon-print set-right" data-toggle="tooltip"
                       data-original-title="<?php echo Yii::t('app', 'PRINT REPORT'); ?>"></i>
                </a>
                <a href="/project/report/id/<?php echo e($project->id); ?>/code/<?php echo e($project->uuid); ?>" class=" btn btn-success right">
                    <?php echo Yii::t('app', 'Report'); ?>
                </a>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="crud" <?php if (!empty($selected)) : ?> data-current="<?php echo e($selected); ?>" <?php endif; ?>>
              <div class="visible-xs mobile-submenu">
                <ul class="nav navbar-nav">
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo Yii::t('app', 'Project modules'); ?></a>
                    <?php $this->renderPartial('list', array('modules' => $modules,
                                                             'class' => 'modules-menu',
                                                             'selected' => $selected,
                                                             'projectid' => $project->id)); ?>
                  </li>
                </ul>
              </div>
              <div class="row crud-row">
                <div class="col-md-6 col-sm-6 col-xs-4">
                  <div class="main-button-options">
                    <ul>
                      <li>
                        <button class="btn btn-success crud-btn crud-btn-create" data-action="new" data-target="/module/create/projectid/<?php echo e($project->id); ?>">
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
                        <button class="<?php echo $hide; ?> crud-btn crud-btn-edit col-xs-6 input-group-addon" data-action="edit" data-target="/module/update/projectid/<?php echo e($project->id); ?>">
                          <?php echo Yii::t('app', 'Edit'); ?>
                        </button>
                      </li>
                      <li>
                        <button class="<?php echo $hide; ?> crud-btn crud-btn-edit col-xs-6 input-group-addon" data-action="confirm" data-target="/module/confirm/projectid/<?php echo e($project->id); ?>"
                          data-confirm-action="delete" data-confirm-target="/module/delete/projectid/<?php echo e($project->id); ?>"
                          data-confirm-title="<?php echo Yii::t('app', 'Delete confirmation'); ?>"
                          data-confirm-heading="<?php echo Yii::t('app', 'Are you sure you want delete this module?'); ?>">
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
                    <?php $this->renderPartial('list', array('class' => 'modules-list', 'modules' => $modules,
                                                             'selected' => $selected, 'projectid' => $project->id)); ?>
                  </div>
                  <div class="col-md-6 col-sm-6 edit-form">
                    <div class="crud-container">
                      <?php if (!empty($selected) && !empty($current))
                        $this->renderPartial('view', array('model' => $current, 'projectid' => $project->id));
                      ?>
                    </div>
                  </div>
                </div>
              </div>
              <?php $this->widget('application.widgets.ConfirmModal'); ?>
            </div>
        </div>
    </div>
</article>

