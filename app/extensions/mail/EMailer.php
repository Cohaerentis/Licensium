<?php

require_once('class.phpmailer.php');
require_once('class.smtp.php');

class EMailer extends PHPMailer {
    public $viewPath = 'application.views.mail';
    public $savePath = false;

    protected function viewFile($view) {
        if (empty($view)) return false;

        $view = $this->viewPath . '.' . $view;
wrlog('EMailer::viewFile : view = ' . var_export($view, true));
        // In web application, use existing method
        if (isset(Yii::app()->controller)) {
            return Yii::app()->controller->getViewFile($view);
        }

        $file = Yii::getPathOfAlias($view);
        if (is_file($file . '.php')) {
            return Yii::app()->findLocalizedFile($file . '.php');
        } else {
            return false;
        }
    }

    protected function render($view, $data = null) {
        if (($file = $this->viewFile($view)) !== false) {
            if (isset(Yii::app()->controller)) $controller = Yii::app()->controller;
            else                               $controller = new CController(__CLASS__);

wrlog('EMailer::render : file = ' . var_export($file, true));
            return $controller->renderInternal($file, $data, true);
        }
        return false;
    }

    public function renderHTML($view, $data = null) {
        $view = $view . '_html';
        return $this->render($view, $data);
    }

    public function renderText($view, $data = null) {
        $view = $view . '_text';
        return $this->render($view, $data);
    }

    public function renderAndSend($view, $data = null, $options = array()) {
        $emailvalidator = new CEmailValidator();

        $html = !empty($view) ? $this->renderHTML($view, $data) : '';
        $text = !empty($view) ? $this->renderText($view, $data) : '';

        if (!empty($html)) {
            $this->MsgHTML($html);
            if (!empty($text)) $this->AltBody = $text;
        } else if (!empty($text)) {
            $this->isHTML(false);
            $this->Body = $text;
        } else if (!empty($options['message'])) {
            $this->isHTML(false);
            $this->Body = $options['message'];
        } else {
            $this->setError(Yii::t('app', 'View {view} not found', array('{view}' => $view)));
            return false;
        }

        // Set From
        if (!empty($options['from']) && $emailvalidator->validateValue($options['from'])) {
            $fromname = !empty($options['fromname']) ? $options['fromname'] : '';
            $this->SetFrom($options['from'], $fromname);
        }

        // Set To
        if (!empty($options['to'])) {
            $this->clearAddresses();
            $this->setAddresses('to', $options['to']);
        }

        // Set Cc
        if (!empty($options['cc'])) {
            $this->clearCCs();
            $this->setAddresses('cc', $options['cc']);
        }

        // Set Bcc
        if (!empty($options['bcc'])) {
            $this->clearBCCs();
            $this->setAddresses('bcc', $options['bcc']);
        }

        // Set ReplyTo
        if (!empty($options['replyto'])) {
            $this->clearReplyTos();
            $this->setAddresses('Reply-To', $options['replyto']);
        }

        // Set Subject
        if (!empty($options['subject'])) {
            $this->Subject = $options['subject'];
        }

        return $this->send();
    }

    public function html2text($html, $advanced = false) {
        // Avoid to use extras/class.html2text.php (GPL licensed)
        return parent::html2text($html, false);
    }

    public function init() {

    }

    public function send() {
        $result = parent::send();
wrlog('EMailer::send : result = ' . var_export($result, true));
        if ($result) $this->save();
        return $result;
    }

    protected function setAddresses($kind, $addresses) {
        $emailvalidator = new CEmailValidator();

        if (!is_array($addresses)) {
            $addresses = (array) $addresses;
        }

        $anyerror = false;
        foreach ($addresses as $key => $value) {
            $address = is_int($key) ? $value : $key;
            $name    = is_int($key) ? ''     : $value;
            if ($emailvalidator->validateValue($address)) {
                $result = $this->addAnAddress($kind, $address, $name);
            }
            if (!$anyerror && !$result) $anyerror = true;
        }

        return !$anyerror;
    }

    protected function save() {
wrlog('EMailer::save : savePath = ' . var_export($this->savePath, true));
        if (!empty($this->savePath) && is_dir($this->savePath) && is_writable($this->savePath)) {
            $filename = date('Ymd_His') . '_' . uniqid() . '.eml';
wrlog('EMailer::save : filename = ' . var_export($filename, true));

            try {
                $file = fopen($this->savePath . DIRECTORY_SEPARATOR . $filename, 'w+');
                fwrite($file, $this->GetSentMIMEMessage());
                fclose($file);

                return true;
            } catch(Exception $e) {
wrlog('EMailer::save : error = ' . var_export($e->getMessage(), true));
                $this->SetError($e->getMessage());
                return false;
            }
        }
    }
}