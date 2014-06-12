<?php
$aux = 1;
$total = count($modules);
$compclasses = array(
  Compatible::STATUS_INCOMPATIBLE => 'incompatible',
  Compatible::STATUS_COMPATIBLE   => 'compatible',
  Compatible::STATUS_UNKNOWN      => 'unknown',
  Compatible::STATUS_DISABLED     => 'disabled',
);

?>
<?php if (!empty($modules)) : ?>
  <ul <?php if (!empty($class)) : echo 'class="' . $class . '"'; endif; ?>>
    <?php foreach ($modules as $item) :
      $compatibility = $item->compatibility();
      $itemclasses = array('item');
      $switchclasses = array('switcher');
      $switchurl = '';
      if (!empty($selected) && ($item->id == $selected)) {
        $current = $item;
        $itemclasses[] = 'item-selected';
      }
      if (empty($item->enabled)) {
        $itemclasses[] = 'off-element';
        $switchclasses[] = 'on-element switcher-off';
        $switchurl = "/module/enable/projectid/{$projectid}/id/{$item->id}";
      } else {
        $switchclasses[] = 'switcher-on';
        $switchurl = "/module/disable/projectid/{$projectid}/id/{$item->id}";
      }

    ?>
      <li class="<?php echo implode(' ', $itemclasses); ?>">
        <i class="glyphicon glyphicon-cog cog <?php echo $compclasses[$compatibility['status']]; ?>" ></i>
       <span class="crud-item"
        data-action="view" data-id="<?php echo e($item->id); ?>" data-target="/module/view/projectid/<?php echo e($projectid); ?>">
          <?php echo e($item->name); ?>
        </span>


        <?php if(($aux == $total)  && ($total > 1)): ?>
          <a href="/module/up/projectid/<?php echo e($projectid); ?>/id/<?php echo e($item->id); ?>">
            <i class="glyphicon glyphicon-chevron-up move-arrow" data-toggle="tooltip"
               data-original-title="<?php echo Yii::t('app', 'Set a lower priority'); ?>"></i>
          </a>
        <?php endif; ?>
        <?php if(($aux == 1) && ($total > 1)): ?>
          <a href="/module/down/projectid/<?php echo e($projectid); ?>/id/<?php echo e($item->id); ?>">
            <i class="glyphicon glyphicon-chevron-down move-arrow " data-toggle="tooltip"
               data-original-title="<?php echo Yii::t('app', 'Set a higher priority'); ?>"></i>
          </a>
        <?php endif; ?>
        <?php if(($total > 1) && ($aux != 1) && ($aux != $total)): ?>
          <a href="/module/up/projectid/<?php echo e($projectid); ?>/id/<?php echo e($item->id); ?>">
            <i class="glyphicon glyphicon-chevron-up move-arrow set-right" data-toggle="tooltip"
               data-original-title="<?php echo Yii::t('app', 'Set a lower priority'); ?>"></i>
          </a>
          <a href="/module/down/projectid/<?php echo e($projectid); ?>/id/<?php echo e($item->id); ?>">
            <i class="glyphicon glyphicon-chevron-down move-arrow" data-toggle="tooltip"
               data-placement="right"
               data-original-title="<?php echo Yii::t('app', 'Set a higher priority'); ?>"></i>
      </a>
        <?php endif; ?>
        <a href="<?php echo $switchurl; ?>" class="<?php echo implode(' ', $switchclasses); ?>"></a>
      </li></a>
    <?php $aux ++; endforeach; ?>
  </ul>
<?php else : ?>
  <?php echo Yii::t('app', 'No modules found. You can create a new one right now!'); ?>
<?php endif; ?>

