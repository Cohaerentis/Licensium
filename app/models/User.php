<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $email
 * @property string $password
 * @property integer $privileges
 * @property string $firstname
 * @property string $lastname
 * @property string $company
 * @property string $emailold
 * @property string $secret
 * @property string $secretdate
 * @property string $registerdate
 * @property string $modifydate
 * @property string $lastaccess
 * @property integer $deleted
 * @property integer $confirmed
 * @property integer $dontemailme
 */
class User extends CActiveRecord {
    const CACHE_PREFIX = 'user';
    const CACHE_EXPIRATION = 86400; // seconds, 1 day
    const SECRET_EXPIRATION = 3600; // seconds, 1 hour

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email, password', 'required'),
            array('password', 'length', 'min' => 8),
            array('email', 'email'),
            array('email', 'unique'),
            array('privileges, deleted, confirmed, dontemailme', 'numerical', 'integerOnly'=>true),
            array('email, firstname, lastname, company, emailold', 'length', 'max'=>100),
            array('password, secret', 'length', 'max'=>80),
            array('secretdate, registerdate, modifydate, lastaccess', 'length', 'max'=>11),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, email, password, privileges, firstname, lastname, company, emailold, secret, secretdate, registerdate, modifydate, lastaccess, deleted, confirmed, dontemailme', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
//            'projects' => array(self::HAS_MANY, 'Project', 'user_id', 'together' => false),
        );
    }

    public function attributesClear(&$attributes, $context = 'create') {
        unset($attributes['id']);
        unset($attributes['emailold']);
        unset($attributes['secret']);
        unset($attributes['secretdate']);
        unset($attributes['privileges']);
        unset($attributes['registerdate']);
        unset($attributes['modifydate']);
        unset($attributes['lastaccess']);
        unset($attributes['deleted']);
        unset($attributes['confirmed']);

        if ($context != 'create') unset($attributes['password']);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id'                => Yii::t('app', 'ID'),
            'email'             => Yii::t('app', 'Email'),
            'password'          => Yii::t('app', 'Password'),
            'privileges'        => Yii::t('app', 'Privileges'),
            'firstname'         => Yii::t('app', 'Firstname'),
            'lastname'          => Yii::t('app', 'Lastname'),
            'company'           => Yii::t('app', 'Company'),
            'emailold'          => Yii::t('app', 'Old email'),
            'secret'            => Yii::t('app', 'Secret'),
            'secretdate'        => Yii::t('app', 'Secret date'),
            'registerdate'      => Yii::t('app', 'Register date'),
            'modifydate'        => Yii::t('app', 'Modify date'),
            'lastaccess'        => Yii::t('app', 'Last access'),
            'deleted'           => Yii::t('app', 'Deleted'),
            'confirmed'         => Yii::t('app', 'Confirmed'),
            'dontemailme'       => Yii::t('app', 'Don\'t email me'),
        );
    }

    public function registerDatePrint() {
        $dateFormatter = Yii::app()->getDateFormatter();
        return $dateFormatter->formatDateTime($this->registerdate, 'medium', null);
    }

    public function fullName() {
        $name = Yii::t('app', 'Unnamed');
        $parts = array();
        if (!empty($this->firstname)) $parts[] = $this->firstname;
        if (!empty($this->lastname))  $parts[] = $this->lastname;
        if (!empty($parts))           $name = implode(' ', $parts);
        return $name;
    }

    protected function afterSave() {
        $this->cacheUpdate();
    }

    protected function afterDelete() {
        $this->cacheUpdate(true);
    }

    protected function cacheUpdate($deleted = false) {
        // Write cache with saved object
        // - For getByName
        $key = self::CACHE_PREFIX . ':id:' . $this->id;
        if (!$deleted) Yii::app()->cache->set($key, $this, self::CACHE_EXPIRATION);
        else           Yii::app()->cache->delete($key);

        // - For getAll
        $key = self::CACHE_PREFIX . ':all';
        Yii::app()->cache->delete($key);

    }

    public static function getById($id, $nocache = false) {
        // Read Cache
        $key = self::CACHE_PREFIX . ':id:' . $id;
        if ( $nocache || ($value = Yii::app()->cache->get($key)) === false ) {
            $criteria = new CDbCriteria();
            $criteria->compare('id', $id);
            $value = self::model()->find($criteria);
            Yii::app()->cache->set($key, $value, self::CACHE_EXPIRATION);
        }
        return $value;
    }

    public static function getAll($nocache = false) {
        // Read Cache
        $key = self::CACHE_PREFIX . ':all';
        if ( $nocache || ($all = Yii::app()->cache->get($key)) === false ) {
            $all = self::model()->findAll();
            Yii::app()->cache->set($key, $all, self::CACHE_EXPIRATION);
        }
        return $all;
    }

    public function passwordChange($newpassword) {
        if (!empty($newpassword)) {
            $this->password = CPasswordHelper::hashPassword($newpassword);
        }
    }

    public function secretSet() {
        $newsecret = randomString(32);
        $this->secret = CPasswordHelper::hashPassword($newsecret);
        $this->secretdate = time();

        return $newsecret;
    }

    public function secretReset() {
        $this->secret = '';
        $this->secretdate = 0;

        return true;
    }

    public function secretCheck($code) {
        $now = time();
        if (!empty($code) && ($now < ($this->secretdate + self::SECRET_EXPIRATION)) &&
            CPasswordHelper::verifyPassword($code, $this->secret)) {
            return true;
        }
        return false;
    }

    public function emailChange($newemail) {
        $emailvalidator = new CEmailValidator();
        if ( ($this->email != $newemail) && ($emailvalidator->validateValue($newemail)) ) {
            $this->emailold = $newemail;
            return $this->secretSet();
        }

        return false;
    }

    public function emailConfirm($code) {
        if ($this->secretCheck($code)) {
            if (!empty($this->emailold)) {
                $this->emailold = '';
            }
            $this->confirmed = 1;
            $this->secretReset();

            return true;
        }

        return false;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('password',$this->password,true);
        $criteria->compare('privileges',$this->privileges);
        $criteria->compare('firstname',$this->firstname,true);
        $criteria->compare('lastname',$this->lastname,true);
        $criteria->compare('company',$this->company,true);
        $criteria->compare('emailold',$this->emailold,true);
        $criteria->compare('secret',$this->secret,true);
        $criteria->compare('secretdate',$this->secretdate,true);
        $criteria->compare('registerdate',$this->registerdate,true);
        $criteria->compare('modifydate',$this->modifydate,true);
        $criteria->compare('lastaccess',$this->lastaccess,true);
        $criteria->compare('deleted',$this->deleted);
        $criteria->compare('confirmed',$this->confirmed);
        $criteria->compare('dontemailme',$this->dontemailme);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }
}
