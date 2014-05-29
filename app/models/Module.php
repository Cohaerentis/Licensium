<?php

/**
 * This is the model class for table "module".
 *
 * The followings are the available columns in table 'module':
 * @property string $id
 * @property string $project_id
 * @property string $name
 * @property string $license_id
 * @property string $licenseother
 * @property string $website
 * @property string $repo
 * @property string $relation
 * @property string $type
 * @property string $day
 * @property string $month
 * @property string $year
 * @property string $createdate
 * @property string $priority
 */
class Module extends CActiveRecord {
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'module';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('project_id, name, type', 'required'),
            array('project_id, license_id', 'length', 'max'=>20),
            array('name', 'length', 'max'=>100),
            array('licenseother, website, repo', 'length', 'max'=>256),
            array('relation, priority', 'length', 'max'=>3),
            array('type', 'length', 'max'=>1),
            array('day, month', 'length', 'max'=>2),
            array('year', 'length', 'max'=>4),
            array('createdate', 'length', 'max'=>11),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, project_id, name, license_id, licenseother, website, repo, relation, type, day, month, year, createdate, priority', 'safe', 'on'=>'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id'            => Yii::t('app', 'ID'),
            'project_id'    => Yii::t('app', 'Project'),
            'name'          => Yii::t('app', 'Name'),
            'license_id'    => Yii::t('app', 'License'),
            'licenseother'  => Yii::t('app', 'Licenseother'),
            'website'       => Yii::t('app', 'Website'),
            'repo'          => Yii::t('app', 'Repo'),
            'relation'      => Yii::t('app', 'Relation'),
            'type'          => Yii::t('app', 'Type'),
            'day'           => Yii::t('app', 'Day'),
            'month'         => Yii::t('app', 'Month'),
            'year'          => Yii::t('app', 'Year'),
            'createdate'    => Yii::t('app', 'Createdate'),
            'priority'      => Yii::t('app', 'Priority'),
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
        $criteria->compare('project_id',$this->project_id,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('license_id',$this->license_id,true);
        $criteria->compare('licenseother',$this->licenseother,true);
        $criteria->compare('website',$this->website,true);
        $criteria->compare('repo',$this->repo,true);
        $criteria->compare('relation',$this->relation,true);
        $criteria->compare('type',$this->type,true);
        $criteria->compare('day',$this->day,true);
        $criteria->compare('month',$this->month,true);
        $criteria->compare('year',$this->year,true);
        $criteria->compare('createdate',$this->createdate,true);
        $criteria->compare('priority',$this->priority,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Module the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }
}
