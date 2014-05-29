<?php

/**
 * This is the model class for table "license".
 *
 * The followings are the available columns in table 'license':
 * @property string $id
 * @property string $label
 * @property string $name
 * @property string $url
 */
class License extends CActiveRecord {
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'license';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('label', 'required'),
            array('label', 'length', 'max'=>10),
            array('name', 'length', 'max'=>100),
            array('url', 'length', 'max'=>256),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, label, name, url', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id'    => Yii::t('app', 'ID'),
            'label' => Yii::t('app', 'Label'),
            'name'  => Yii::t('app', 'Name'),
            'url'   => Yii::t('app', 'Url'),
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
        $criteria->compare('label',$this->label,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('url',$this->url,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return License the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }
}
