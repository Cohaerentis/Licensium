<?php
class ChosenSelect extends CWidget {

    public $class       = '';
    public $id          = '';
    public $valuefield  = 'id';
    public $labelfield  = 'name';
    public $placeholder = '';
    public $model       = '';
    public $name        = '';
    public $current     = array();
    public $available   = array();
    public $type        = 'single';
    public $htmlOptions = array();

    public $items       = array();

    public function run() {
        if (is_string($this->current)) $this->current = array($this->current);
        if (!empty($this->available) && !empty($this->model) &&
            !empty($this->name) ) {
            $v = $this->valuefield;
            $l = $this->labelfield;
            foreach($this->available as $option) {
                $item = new stdClass();
                $item->value = $option->$v;
                $item->label = $option->$l;
                $item->selected = !empty($this->current) ? in_array($option->$v, $this->current) : false;
                $this->items[$item->value] = $item;
            }
            $this->render("chosen-{$this->type}-select");
        }
    }

}
