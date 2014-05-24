<?php

class EPrivilegesControlFilter extends CFilter {
    public $privileges = 0;

    protected function preFilter($filterChain) {
        $user = Yii::app()->getUser();
        if ($user->getIsGuest()) {
            $user->loginRequired();
        }
        if ($user->privileges < $this->privileges) {
            throw new CHttpException(403, Yii::t('app', 'Sorry, you do not have enought privileges to perform this action'));
        }
        return parent::preFilter($filterChain);
    }

    protected function postFilter($filterChain) {
        return parent::postFilter($filterChain);
    }

    protected function accessDenied($user,$message) {
        if ($user->getIsGuest()) {
            $user->loginRequired();
        } else {
            throw new CHttpException(403, $message);
        }
    }
}