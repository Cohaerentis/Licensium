<select
    multiple
    name="<?php echo e($this->model); ?>[<?php echo e($this->name); ?>][]"
    class="chosen-select <?php echo e($this->class);?>"
    <?php if (!empty($this->id)) : ?>id="<?php echo e($this->id);?>"<?php endif; ?>
    data-placeholder="<?php echo e($this->placeholder);?>"
>
    <option value=""></option>
    <?php foreach ($this->items as $item): ?>
        <option
            value="<?php echo e($item->value) ?>"
            <?php if ($item->selected): ?>selected<?php endif ?>
        >
        <?php echo e($item->label); ?>
        </option>
    <?php endforeach ?>
</select>
