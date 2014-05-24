<?php

/**
 * RememberForm class.
 * RememberForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RememberForm extends CFormModel {
    public $email;

    /**
     * Declares the validation rules.
     * The rules state that email and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            // email are required
            array('email', 'required'),
            array('email', 'email'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'email'         => Yii::t('app', 'Email address'),
        );
    }

}
