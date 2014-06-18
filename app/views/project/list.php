<?php if (!empty($projects)) : ?>
  <ul <?php if (!empty($class)) : echo 'class="' . $class . '"'; endif; ?>>
    <?php foreach ($projects as $item) :
      $itemclasses = array('item');
      if (!empty($selected) && ($item->id == $selected)) {
        $current = $item;
        $itemclasses[] = 'item-selected';
      }

    ?>
      <li class="<?php echo implode(' ', $itemclasses); ?>">
        <i class="glyphicon glyphicon-tasks cog <?php echo Compatible::statusClass($item->compatibility()['status']); ?>"  ></i>
        <span class="crud-item" data-name="<?php echo e($item->name); ?>"
              data-status="<?php echo Compatible::statusClass($item->compatibility()['status']); ?>"
              data-action="view" data-id="<?php echo e($item->id); ?>" data-target="/project/view">
          <?php echo truncate(e($item->name)); ?>
        </span>
      </li>
    <?php endforeach; ?>
  </ul>
<?php else : ?>
  <?php echo Yii::t('app', 'No projects found. You can create a new one right now!'); ?>
<?php endif; ?>
