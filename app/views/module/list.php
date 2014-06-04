<?php if (!empty($modules)) : ?>
  <ul <?php if (!empty($class)) : echo 'class="' . $class . '"'; endif; ?>>
    <?php foreach ($modules as $item) : ?>
      <li <?php if (!empty($selected) && ($item->id == $selected)) : $current = $item; ?>class="item-selected"<?php endif; ?>>
        <i class="glyphicon glyphicon-cog cog"  ></i>
        <span class="crud-item"
        data-action="view" data-id="<?php echo e($item->id); ?>" data-target="/module/view/projectid/<?php echo e($projectid); ?>">
          <?php echo e($item->name); ?>
        </span>
      </li>
    <?php endforeach; ?>
  </ul>
<?php else : ?>
  <?php echo Yii::t('app', 'No modules found. You can create a new one right now!'); ?>
<?php endif; ?>
