<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {
    private $_id;

    public  $email;

    const ERROR_EMAIL_INVALID = 3;

    public function __construct($email, $password) {
        $this->email    = $email;
        $this->password = $password;
    }

    /**
     * Authenticates user.
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
//        $salt = Yii::app()->params['passwordSalt'];
        $record = User::model()->findByAttributes(array('email' => $this->email));
        if (empty($record)) {
            $this->errorCode = self::ERROR_EMAIL_INVALID;
//        } else if ($record->password !== sha1($this->password . $salt)) {
        } else if (!CPasswordHelper::verifyPassword($this->password, $record->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->_id = $record->id;
            $this->setState('firstname',    $record->firstname);
            $this->setState('lastname',     $record->lastname);
            $this->setState('email',        $record->email);
            $this->setState('confirmed',    $record->confirmed);
            $this->setState('privileges',   $record->privileges);

            // Save last access time
            $record->lastaccess = time();
            $record->save();

            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId() {
        // We can access UserID from Yii::app()->user->id
        return $this->_id;
    }
}