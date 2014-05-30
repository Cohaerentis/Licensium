<?php if (!empty($projects)) : ?>
  <ul <?php if (!empty($class)) : echo 'class="' . $class . '"'; endif; ?>>
    <?php foreach ($projects as $item) : ?>
      <li <?php if (!empty($selected) && ($item->id == $selected)) : $current = $item; ?>class="item-selected"<?php endif; ?>>
        <span class="crud-item"
        data-action="view" data-id="<?php echo e($item->id); ?>" data-target="/project/view">
          <?php echo e($item->name); ?>
        </span>
      </li>
    <?php endforeach; ?>
  </ul>
<?php else : ?>
  <?php echo Yii::t('app', 'No projects found. You can create a new one right now!'); ?>
<?php endif; ?>
