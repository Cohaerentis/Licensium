<?php
class ConfirmModal extends CWidget {

    public $class       = '';
    public $id          = '';
    public $title       = '';
    public $heading     = '';
    public $labelno     = 'No';
    public $labelyes    = 'Yes';
    public $target      = '#';
    public $action      = '';

    public function run() {
        $this->render('confirm-modal');
    }

}
