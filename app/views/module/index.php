<?php
/* @var $this ModuleController */
/* @var $modules Module list for current Project */
/* @var $project Current Project */
/* @var $selected Module ID selected */

// If selected not defined, define to none
$compatibility = $project->compatibility();
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
<div class="module-index-wrapper common-index-wrapper">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="page-title">
                <h2 class="section-title"><?php echo Yii::t('app', 'Modules integrated in ') . e($project->name); ?></h2>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <?php if ($compatibility['status'] != Compatible::STATUS_COMPATIBLE) : ?>
                <?php if (!empty($compatibility['conflicts'])): ?>
                    <div class="alert alert-danger">
                        <p><?php echo Yii::t('app','There are some modules with licenses incompatibility issues:');?></p>
                        <?php foreach ($compatibility['conflicts'] as $module): ?>
                            <i class="glyphicon glyphicon-thumbs-down thumbs" ></i><?php echo $module->name; ?><br>
                        <?php endforeach;?>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="alert alert-success">
                    <?php echo Yii::t('app','Well done!! Your project has no compatibility problems.')?>
                    <i class="glyphicon glyphicon-thumbs-up" ></i><br>
                </div>
            <?php endif; ?>
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
                <div class="row">
                    <div class="crud-row">
                      <div class="col-md-6 col-sm-6 col-xs-6">
                          <div id="anchor" class="main-button-options">
                                <button class="btn btn-success crud-btn crud-btn-create" data-action="new" data-target="/module/create/projectid/<?php echo e($project->id); ?>">
                                  <?php echo Yii::t('app', 'Create'); ?>
                                </button>
                          </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="row">
                              <div class="main-button-options edition-buttons">
                                <div class="col-sm-6 col-xs-6">
                                    <button class="<?php echo $hide; ?> crud-btn crud-btn-edit edit input-group-addon" data-action="edit" data-target="/module/update/projectid/<?php echo e($project->id); ?>">
                                      <?php echo Yii::t('app', 'Edit'); ?>
                                    </button>
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <button class="<?php echo $hide; ?> crud-btn crud-btn-edit delete input-group-addon" data-action="confirm" data-target="/module/confirm/projectid/<?php echo e($project->id); ?>"
                                      data-confirm-action="delete" data-confirm-target="/module/delete/projectid/<?php echo e($project->id); ?>"
                                      data-confirm-title="<?php echo Yii::t('app', 'You are about to delete forever one of your modules'); ?>"
                                      data-confirm-heading="<?php echo Yii::t('app', "You've been warned but even so you want to delete it, go ahead!"); ?>">
                                      <?php echo Yii::t('app', 'Delete'); ?>
                                    </button>
                                </div>
                              </div>
                            </div>
                      </div>
                    </div>
              </div>
              <div class="row">
                <div class="clearfix content-wrapper wrapper-list">
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
</div>

