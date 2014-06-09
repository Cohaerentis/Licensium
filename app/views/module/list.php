<?php
$aux = 1;
$total = count($modules);
$compatible = 1;

?>
<?php if (!empty($modules)) : ?>
  <ul <?php if (!empty($class)) : echo 'class="' . $class . '"'; endif; ?>>
    <?php foreach ($modules as $item) : ?>
      <li <?php if (!empty($selected) && ($item->id == $selected)) : $current = $item; ?>class="item-selected"<?php endif; ?>>
        <i class="glyphicon glyphicon-cog cog <?php echo $compatible = true ? 'compatible' : 'uncompatible'; ?>" ></i>
        <span class="crud-item"
        data-action="view" data-id="<?php echo e($item->id); ?>" data-target="/module/view/projectid/<?php echo e($projectid); ?>">
          (<?php echo e($item->priority); ?>) <?php echo e($item->name); ?>
        </span>
        <?php if(($aux == $total)  && ($total > 1)): ?>
          <a href="/module/up/projectid/<?php echo e($projectid); ?>/id/<?php echo e($item->id); ?>">
            <i class="glyphicon glyphicon-chevron-up move-arrow" alt="<?php Yii::t('app', 'Move up'); ?>" ></i>
          </a>
        <?php endif; ?>
        <?php if(($aux == 1) && ($total > 1)): ?>
          <a href="/module/down/projectid/<?php echo e($projectid); ?>/id/<?php echo e($item->id); ?>">
            <i class="glyphicon glyphicon-chevron-down move-arrow " title="<?php Yii::t('app', 'Move down'); ?>" ></i>
          </a>
        <?php endif; ?>
        <?php if(($total > 1) && ($aux != 1) && ($aux != $total)): ?>
          <a href="/module/up/projectid/<?php echo e($projectid); ?>/id/<?php echo e($item->id); ?>">
            <i class="glyphicon glyphicon-chevron-up move-arrow" title="<?php Yii::t('app', 'Move up'); ?>" ></i>
          </a>
          <a href="/module/down/projectid/<?php echo e($projectid); ?>/id/<?php echo e($item->id); ?>">
            <i class="glyphicon glyphicon-chevron-down move-arrow" title="<?php Yii::t('app', 'Move down'); ?>" ></i>
          </a>
        <?php endif; ?>
      </li>
    <?php $aux ++; endforeach; ?>
  </ul>
<?php else : ?>
  <?php echo Yii::t('app', 'No modules found. You can create a new one right now!'); ?>
<?php endif; ?>
