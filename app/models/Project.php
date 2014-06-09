<?php

/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property string $id
 * @property string $user_id
 * @property string $name
 * @property string $website
 * @property string $repo
 * @property string $license_id
 * @property string $licenseother
 * @property string $createdate
 * @property string $uuid
 */
class Project extends CActiveRecord {
    const CACHE_PREFIX = 'project';
    const CACHE_EXPIRATION = 86400; // seconds

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'project';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, name', 'required'),
            array('user_id, license_id', 'length', 'max'=>20),
            array('name, uuid', 'length', 'max'=>100),
            array('website, repo, licenseother', 'length', 'max'=>256),
            array('createdate', 'length', 'max'=>11),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, name, website, repo, license_id, licenseother, createdate, uuid', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'license' => array(self::BELONGS_TO, 'License', 'license_id', 'together' => false),
            'user' => array(self::BELONGS_TO, 'User', 'user_id', 'together' => false),
            'modules' => array(self::HAS_MANY, 'Module', 'project_id', 'order' => 'priority DESC', 'together' => false),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id'            => Yii::t('app', 'ID'),
            'user_id'       => Yii::t('app', 'User'),
            'name'          => Yii::t('app', 'Name'),
            'website'       => Yii::t('app', 'Website'),
            'repo'          => Yii::t('app', 'Repo'),
            'license_id'    => Yii::t('app', 'License'),
            'licenseother'  => Yii::t('app', 'Licenseother'),
            'createdate'    => Yii::t('app', 'Createdate'),
            'uuid'          => Yii::t('app', 'Uuid'),
        );
    }

    public function attributesClear(&$attributes, $context = '') {
        unset($attributes['id']);
        unset($attributes['user_id']);
        unset($attributes['createdate']);
        unset($attributes['uuid']);
    }

    public function createDatePrint() {
        $dateFormatter = Yii::app()->getDateFormatter();
        return $dateFormatter->formatDateTime($this->createdate, 'medium', null);
    }

    public function publicURL() {
        return "/project/public/id/{$this->id}/code/{$this->uuid}";
    }

    public function lastPriority() {
        $priority = 0;
        if (!empty($this->modules)) {
            $priority = $this->modules[0]->priority;
        }
        return $priority;
    }

    protected function afterSave() {
        $this->cacheUpdate();
    }

    protected function afterDelete() {
        $this->cacheUpdate(true);
    }

    protected function cacheUpdate($deleted = false) {
        // Write cache with saved object
        // - For getById
        $key = self::CACHE_PREFIX . ':id:' . $this->id;
        if (!$deleted) Yii::app()->cache->set($key, $this, self::CACHE_EXPIRATION);
        else           Yii::app()->cache->delete($key);

        // - For getByUser
        $key = self::CACHE_PREFIX . ':userid:' . $this->user_id;
        Yii::app()->cache->delete($key);

        // - For getAll
        $key = self::CACHE_PREFIX . ':all';
        Yii::app()->cache->delete($key);
    }

    public static function getById($id, $nocache = false) {
        // Read Cache
        $key = self::CACHE_PREFIX . ':id:' . $id;
        if ( $nocache || ($value = Yii::app()->cache->get($key)) === false ) {
            $value = self::model()->find('id = :id', array('id' => $id));
            Yii::app()->cache->set($key, $value, self::CACHE_EXPIRATION);
        }
        return $value;
    }

    public static function getByUser($userid, $nocache = false) {
        // Read Cache
        $key = self::CACHE_PREFIX . ':userid:' . $userid;
        if ( $nocache || ($value = Yii::app()->cache->get($key)) === false ) {
            $value = self::model()->findAll('user_id = :userid', array('userid' => $userid));
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
        $criteria->compare('user_id',$this->user_id,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('website',$this->website,true);
        $criteria->compare('repo',$this->repo,true);
        $criteria->compare('license_id',$this->license_id,true);
        $criteria->compare('licenseother',$this->licenseother,true);
        $criteria->compare('createdate',$this->createdate,true);
        $criteria->compare('uuid',$this->uuid,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Project the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function compatibility() {
        $global = Compatible::STATUS_COMPATIBLE;
        $compatibility = array(
            'status'    => Compatible::STATUS_COMPATIBLE,
            'conflicts' => array(),
        );
        if (!empty($this->modules)) {
            $found = false;
            foreach ($this->modules as $module) {
                $result = $module->compatibility();
                if ($result['status'] != Compatible::STATUS_COMPATIBLE) {
                    // Get worst compatibility status
                    if (($global == Compatible::STATUS_COMPATIBLE) ||
                        ($result['status'] == Compatible::STATUS_INCOMPATIBLE)) {
                        $global = $result['status'];
                    }
                    $compatibility['conflicts'][$module->id] = $module;
                }
            }
            $compatibility['status'] = $global;
        }
        return $compatibility;
    }

}
