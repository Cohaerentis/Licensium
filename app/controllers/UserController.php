<?php

class UserController extends Controller {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            // 'ajaxOnly + confirm, create, update, delete',
            array('EPrivilegesControlFilter + index, update', 'privileges' => self::PRIVILEGE_USER),
        );
    }

    /**
     * View self user profile.
     */
    public function actionIndex() {
        $model = User::getById(Yii::app()->user->id);
        if (empty($model->confirmed)) {
            $resendlink = CHtml::link(Yii::t('app', 'Resend'),
                Yii::app()->createUrl('user/resend', array('id' => $model->id)) );
            Yii::app()->user->setFlash('warning',
                Yii::t('app', 'Your email is not confirmed yet! {resend} email confirmation',
                    array('{resend}' => $resendlink)));
        }
        $this->render('index', array('model' => $model));
    }

    /**
     * User login
     */
    public function actionLogin() {
        $model = new LoginForm;

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->user->returnUrl);
                Yii::app()->end();
            }
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * User signup
     */
    public function actionSignup() {
        if (!Yii::app()->user->isGuest) {
            Yii::app()->user->logout();
        }

        $model = new User;

        // collect user input data
        if (isset($_POST['User'])) {
            $model->attributesClear($_POST['User'], 'create');
            // Read plain password and hash it
            $plainpass = '';
            if (isset($_POST['User']['password'])) {
                $plainpass = $_POST['User']['password'];
                unset($_POST['User']['password']);
            }
            $model->attributes = $_POST['User'];
            $model->passwordChange($plainpass);
            $secret = $model->secretSet();
            $model->registerdate = time();
            if ($model->save()) {
                $this->confirmationEmailSend($model, $secret);
                $this->render('confirmsent', array('model' => $model));
                Yii::app()->end();
            }
        }

        // display the signup form
        $model->password = '';
        $this->render('signup', array('model' => $model));
    }

    /**
     * User resend confirmation email
     */
    public function actionResend($id = null) {
        $model = false;
        if (!empty($id)) {
            $model = User::getById($id, true);
        } else if (!Yii::app()->user->isGuest) {
            $model = User::getById(Yii::app()->user->id, true);
        }

        // ERROR : Not loggedin or user not found
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'User does not exist.'));
        }

        // ERROR : Already confirmed
        if (!empty($model->confirmed)) {
            Yii::app()->user->setFlash('warning',
                Yii::t('app', 'Your email is already confirmed'));
            if (Yii::app()->user->isGuest) {
                $this->redirect('/user/login');
            } else {
                $this->redirect('/user');
            }
            Yii::app()->end();
        }

        // Resend confirmation email
        $secret = $model->secretSet();
        if ($model->save()) {
            $this->confirmationEmailSend($model, $secret);
            $this->render('confirmsent', array('model' => $model));
        }
    }

    protected function confirmationEmailSend($model, $secret) {
        $result = Yii::app()->mail->renderAndSend('emailconfirm',
            array('model' => $model, 'secret' => $secret),
            array('from'        => Yii::app()->params['noReplyEmail'],
                  'fromname'    => Yii::app()->params['noReplyEmail'],
                  'to'          => array($model->email => $model->fullName()),
                  'subject'     => Yii::t('app', 'Email confirmation'),
            )
        );
        if (!$result) {
            $resendlink = CHtml::link(Yii::t('app', 'Resend'),
                Yii::app()->createUrl('user/resend', array('id' => $model->id)) );
            Yii::app()->user->setFlash('danger',
                Yii::t('app', 'An error ({error}) occurs when sending confirmation email! {resend} email confirmation',
                    array('{resend}' => $resendlink,
                          '{error}'  => Yii::app()->mail->ErrorInfo)));
        }

        return $result;
    }

    /**
     * User email confirmation
     */
    public function actionConfirm($id, $code) {
        $model = User::getById($id, true);

        // ERROR : Not loggedin or user not found
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'User does not exist.'));
        }

        // ERROR : Already confirmed
        if (!empty($model->confirmed)) {
            Yii::app()->user->setFlash('warning',
                Yii::t('app', 'Your email is already confirmed'));
            $this->redirect('/user');
            Yii::app()->end();
        }

        // Confirm user, checking code
        if (!$model->emailConfirm($code)) {
            throw new CHttpException(401, Yii::t('app', 'Invalid code.'));
        }

        if (!$model->save()) {
            throw new CHttpException(500, Yii::t('app', 'Error while confirming user email'));
        }

        // Display that email has been confirmed
        $this->render('confirmed', array('model' => $model));
    }

    /**
     * User remember password form
     */
    public function actionRemember() {
        $model = new RememberForm;

        // collect user input data
        if (isset($_POST['RememberForm'])) {
            $model->attributes = $_POST['RememberForm'];
            if ($model->validate()) {
                $user = User::model()->find('email = :email AND confirmed = 1', array('email' => $model->email));
                if (!empty($user)) {
                    $secret = $user->secretSet();
                    if ($user->save()) {
                        $this->rememberEmailSend($user, $secret);
                    }
                }
                $this->render('remembersent', array('model' => $model));
                Yii::app()->end();
            }
        }

        // display the remember password form
        $this->render('remember', array('model' => $model));
    }

    protected function rememberEmailSend($model, $secret) {
        $result = Yii::app()->mail->renderAndSend('rememberpassword',
            array('model' => $model, 'secret' => $secret),
            array('from'        => Yii::app()->params['noReplyEmail'],
                  'fromname'    => Yii::app()->params['noReplyEmail'],
                  'to'          => array($model->email => $model->fullName()),
                  'subject'     => Yii::t('app', 'Remember password instructions'),
            )
        );
        if (!$result) {
            Yii::app()->user->setFlash('danger',
                Yii::t('app', 'An error ({error}) occurs when sending remember password email!',
                    array('{error}'  => Yii::app()->mail->ErrorInfo)));
        }

        return $result;
    }

    /**
     * User change password by code
     */
    public function actionPassword($id = null, $code = null) {
        $model = new PasswordForm;
        if (Yii::app()->user->isGuest) {
            $user = User::getById($id, true);

            if (empty($model)) {
                throw new CHttpException(404, Yii::t('app', 'User does not exist.'));
            }

            // Check code (secret and secretdate)
            if (!$user->secretCheck($code)) {
                throw new CHttpException(401, Yii::t('app', 'Invalid code.'));
            }
        } else {
            $user = User::getById(Yii::app()->user->id, true);
        }

        // collect user input data
        if (isset($_POST['PasswordForm'])) {
            $model->attributes = $_POST['PasswordForm'];
            if ($model->validate()) {
                $user->passwordChange($model->password);
                if (Yii::app()->user->isGuest) {
                    if (empty($user->confirmed)) {
                        // Confirm user, because this link was received by email
                        $user->emailConfirm($code);
                    } else {
                        $user->secretReset();
                    }
                }
                if ($user->save()) {
                    $this->render('passwordchanged', array('model' => $model, 'user' => $user));
                } else {
                    throw new CHttpException(500, Yii::t('app', 'Error while setting new password'));
                }
                Yii::app()->end();
            }
        }

        // display the change password form
        $this->render('password', array('model' => $model));
    }

    /**
     * Update profile from
     */
    public function actionUpdate() {
        $model = User::getById(Yii::app()->user->id, true);

        // collect user input data
        if (isset($_POST['User'])) {
            $model->attributesClear($_POST['User']);
            $emailold = $model->email;

            $model->attributes = $_POST['User'];
            $model->modifydate = time();
            if ($model->email != $emailold) {
                $model->emailold = $emailold;
                $model->confirmed = 0;
                $secret = $model->secretSet();
            }
            if ($model->save()) {
                Yii::app()->user->setFlash('success', Yii::t('app', 'Profile updated'));
                if ( ($model->email != $emailold) &&
                     ($this->confirmationEmailSend($model, $secret, true)) ) {
                    $this->render('confirmsent', array('model' => $model));
                    Yii::app()->end();
                }
                $this->redirect('/user');
                Yii::app()->end();
            }
        }

        // display update user form
        $this->render('update', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to login again.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect($this->createUrl('user/login'));
    }

}
