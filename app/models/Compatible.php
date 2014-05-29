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
}
