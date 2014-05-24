<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel {
    public $email;
    public $password;
    public $rememberMe;

    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that email and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            // email and password are required
            array('email, password', 'required'),
            array('email', 'email'),
            // rememberMe needs to be a boolean
            array('rememberMe', 'boolean'),
            // password needs to be authenticated
            array('password', 'authenticate'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'rememberMe'    => Yii::t('app', 'Remember me next time'),
            'email'         => Yii::t('app', 'Email address'),
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute,$params) {
        if (!$this->hasErrors()) {
            $this->_identity = new UserIdentity($this->email, $this->password);
            if (!$this->_identity->authenticate())
                $this->addError('password', Yii::t('app', 'Incorrect email or password.'));
        }
    }

    /**
     * Logs in the user using the given email and password in the model.
     * @return boolean whether login is successful
     */
    public function login() {
        if (empty($this->_identity)) {
            $this->_identity = new UserIdentity($this->email, $this->password);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = $this->rememberMe ? 3600*24*30 : 0; // 30 days
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        }
        return false;
    }
}
