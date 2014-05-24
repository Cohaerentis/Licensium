<?php

/**
 * PasswordForm class.
 * PasswordForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class PasswordForm extends CFormModel {
    public $password;
    public $repassword;

    /**
     * Declares the validation rules.
     * The rules state that email and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            // password and repassword are required
            array('password, repassword', 'required'),
            array('password', 'length', 'min' => 8),
            array('repassword', 'compare', 'compareAttribute' => 'password'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'password'      => Yii::t('app', 'New password'),
            'repassword'    => Yii::t('app', 'Re-type password'),
        );
    }

    /**
     * Change user password
     * @return boolean whether login is successful
     */
    public function change($user, $code) {
        // TODO : Change user password using the code
        return true;
    }
}
