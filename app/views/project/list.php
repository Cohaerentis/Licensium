<?php
$compclasses = array(
  Compatible::STATUS_INCOMPATIBLE => 'uncompatible',
  Compatible::STATUS_COMPATIBLE   => 'compatible',
  Compatible::STATUS_UNKNOWN      => 'unknown',
);
?>
<?php if (!empty($projects)) : ?>
  <ul <?php if (!empty($class)) : echo 'class="' . $class . '"'; endif; ?>>
    <?php foreach ($projects as $item) :
      $compatibility = $item->compatibility();
    ?>
      <li <?php if (!empty($selected) && ($item->id == $selected)) : $current = $item; ?>class="item-selected"<?php endif; ?>>
        <i class="glyphicon glyphicon-tasks cog <?php echo $compclasses[$compatibility['status']]; ?>"  ></i>
        <span class="crud-item"
        data-action="view" data-id="<?php echo e($item->id); ?>" data-target="/project/view">
          <?php echo truncate(e($item->name)); ?>
        </span>
      </li>
    <?php endforeach; ?>
  </ul>
<?php else : ?>
  <?php echo Yii::t('app', 'No projects found. You can create a new one right now!'); ?>
<?php endif; ?>
