<?php

/**
 * This is the model class for table "compatible".
 *
 * The followings are the available columns in table 'compatible':
 * @property string $id
 * @property string $left_id
 * @property string $right_id
 * @property string $typeleft
 * @property string $typeright
 * @property string $status
 */
class Compatible extends CActiveRecord {
    const CACHE_PREFIX = 'compatible';
    const CACHE_EXPIRATION = 86400; // seconds

    const STATUS_INCOMPATIBLE   = 0;
    const STATUS_COMPATIBLE     = 1;
    const STATUS_UNKNOWN        = 2;
    const STATUS_DISABLED       = 100;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'compatible';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('typeleft, typeright, status', 'required'),
            array('left_id, right_id', 'length', 'max'=>20),
            array('typeleft, typeright, status', 'length', 'max'=>1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, left_id, right_id, typeleft, typeright, status', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'left' => array(self::BELONGS_TO, 'License', 'left_id', 'together' => false),
            'right' => array(self::BELONGS_TO, 'License', 'right_id', 'together' => false),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id'        => Yii::t('app', 'ID'),
            'left_id'   => Yii::t('app', 'Left'),
            'right_id'  => Yii::t('app', 'Right'),
            'typeleft'  => Yii::t('app', 'Typeleft'),
            'typeright' => Yii::t('app', 'Typeright'),
            'status'    => Yii::t('app', 'Status'),
        );
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
        // $key = self::CACHE_PREFIX . ':id:' . $this->id;
        // if (!$deleted) Yii::app()->cache->set($key, $this, self::CACHE_EXPIRATION);
        // else           Yii::app()->cache->delete($key);

        // - isCompatible
        $key = self::CACHE_PREFIX . ':lid:' . $this->left_id . ':rid:' . $this->right_id .
                                    ':ltype:' . $this->typeleft . ':rtype:' . $this->typeright;
        if (!$deleted) Yii::app()->cache->set($key, $this, self::CACHE_EXPIRATION);
        else           Yii::app()->cache->delete($key);

        // - For getAll
        // $key = self::CACHE_PREFIX . ':all';
        // Yii::app()->cache->delete($key);
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
        $criteria->compare('left_id',$this->left_id,true);
        $criteria->compare('right_id',$this->right_id,true);
        $criteria->compare('typeleft',$this->typeleft,true);
        $criteria->compare('typeright',$this->typeright,true);
        $criteria->compare('status',$this->status,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Compatible the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public static function isCompatible($left, $right, $nocache = false) {
        $value = Compatible::STATUS_UNKNOWN;

        if (!empty($left['licenseid']) && !empty($right['licenseid']) &&
            !empty($left['type']) && !empty($right['type'])) {
            $lid = $left['licenseid'];
            $rid = $right['licenseid'];
            $ltype = strtoupper($left['type']);
            $rtype = strtoupper($right['type']);

            $key = self::CACHE_PREFIX . ':lid:' . $lid . ':rid:' . $rid .
                                        ':ltype:' . $ltype . ':rtype:' . $rtype;
            if ( $nocache || ($value = Yii::app()->cache->get($key)) === false ) {
                $record = self::model()->find(
                    'left_id = :lid AND right_id = :rid AND typeleft = :ltype AND typeright = :rtype',
                    array('lid' => $lid, 'rid' => $rid,
                          'ltype' => $ltype, 'rtype' => $rtype));
                if ($record !== null) {
                    Yii::app()->cache->set($key, $record->status, self::CACHE_EXPIRATION);
                }
            }
        }
        return $value;
    }


    public static function statusPrint($status) {
        switch ($status) {
            case self::STATUS_INCOMPATIBLE: return Yii::t('app', 'Incompatible');
            case self::STATUS_COMPATIBLE:   return Yii::t('app', 'Compatible');
            case self::STATUS_UNKNOWN:
            default:                        return Yii::t('app', 'Unknown');
        }
    }
}
