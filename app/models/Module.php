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
    const CACHE_PREFIX = 'module';
    const CACHE_EXPIRATION = 86400; // seconds

    const RELATION_LIBRARY      = 'LIB';
    const RELATION_MODULE       = 'MOD';
    const RELATION_FRAMEWORK    = 'FWK';
    const RELATION_DESIGN       = 'DSN';
    const RELATION_CONTENT      = 'CON';
    const RELATION_INDEPENDENT  = 'IND';

    const TYPE_STATIC           = 'S';
    const TYPE_DINAMIC          = 'D';

    private static $available = array();

    private static function availableInit() {
        if (empty(self::$available)) {
            self::$available = array(
                'relations' => array(
                    self::RELATION_LIBRARY      => Yii::t('app', 'Library'),
                    self::RELATION_MODULE       => Yii::t('app', 'Module'),
                    self::RELATION_FRAMEWORK    => Yii::t('app', 'Framework'),
                    self::RELATION_DESIGN       => Yii::t('app', 'Design'),
                    self::RELATION_CONTENT      => Yii::t('app', 'Content'),
                    self::RELATION_INDEPENDENT  => Yii::t('app', 'Independent application'),
                ),
                'types' => array(
                    self::TYPE_STATIC           => Yii::t('app', 'Static'),
                    self::TYPE_DINAMIC          => Yii::t('app', 'Dinamic'),
                ),
            );
        }
    }

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
            array('year', 'ESeparatedDateValidator', 'limit' => 0,
                  'allowEmpty' => array('day' => true, 'month' => true, 'year' => false)),
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
            'project' => array(self::BELONGS_TO, 'Project', 'project_id', 'together' => false),
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
            'licenseother'  => Yii::t('app', 'Other'),
            'website'       => Yii::t('app', 'Website'),
            'repo'          => Yii::t('app', 'Repo'),
            'relation'      => Yii::t('app', 'Relation'),
            'type'          => Yii::t('app', 'Type'),
            'day'           => Yii::t('app', 'Day'),
            'month'         => Yii::t('app', 'Month'),
            'year'          => Yii::t('app', 'Year'),
            'integrationdate' => Yii::t('app', 'Integration date'),
            'createdate'    => Yii::t('app', 'Createdate'),
            'priority'      => Yii::t('app', 'Priority'),
        );
    }

    public function attributesClear(&$attributes, $context = '') {
        unset($attributes['id']);
        unset($attributes['project_id']);
        unset($attributes['createdate']);
        unset($attributes['priority']);
    }

    public function fullLicense() {
        if (!empty($this->license)) {
            return CHtml::link(e($this->license->name), e($this->license->url));
        } else if (!empty($this->licenseother)) {
            return CHtml::link(Yii::t('app', 'Other'), e($this->licenseother));
        } else {
            return Yii::t('app', 'No license defined');
        }
    }

    public function fullRelation() {
        self::availableInit();
        $relation = strtoupper($this->relation);
        if (!empty(self::$available['relations'][$relation])) return self::$available['relations'][$relation];
        return $this->relation;
    }

    public function fullType() {
        self::availableInit();
        $type = strtoupper($this->type);
        if (!empty(self::$available['types'][$type])) return self::$available['types'][$type];
        return $this->type;
    }

    public function fullIntegrationDate() {
        $format = '';
        $day   = !empty($this->day) ? $this->day : 1;
        $month = !empty($this->month) ? $this->month : 1;
        $year  = !empty($this->year) ? $this->year : date('Y');
        $timestamp = mktime(0, 0, 0, $month, $day, $year);

        $dateFormatter = Yii::app()->getDateFormatter();
        $format = 'yyyy';
        if (!empty($this->month)) $format = 'MMMM yyyy';
        if (!empty($this->day)) $format = '';

        if (!empty($format)) return mb_convert_case($dateFormatter->format($format, $timestamp), MB_CASE_TITLE, "UTF-8");
        else return $dateFormatter->formatDateTime($timestamp, 'medium', null);
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
        $key = self::CACHE_PREFIX . ':projectid:' . $this->project_id;
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

    public static function getByProject($projectid, $nocache = false) {
        // Read Cache
        $key = self::CACHE_PREFIX . ':projectid:' . $projectid;
        if ( $nocache || ($value = Yii::app()->cache->get($key)) === false ) {
            $criteria = new CDbCriteria();
            $criteria->compare('project_id', $projectid);
            $criteria->order = 'priority DESC';
            $value = self::model()->findAll($criteria);
            // $value = self::model()->findAll('project_id = :projectid', array('projectid' => $projectid));
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

    public function priorityChange($change, $project) {
        if (!empty($project) && ($project->id == $this->project_id)) {
            $change = strtolower($change);
            $maxpriority = count($project->modules);
            $order = array();
            $priority = $maxpriority;
            $current = 0;   // Element to up or down
            $target = 0;    // Element affected, to be exchanged with current

            // Prepare current priority list
            foreach($project->modules as $module) {
                $order[$priority] = $module;
                if ($module->id == $this->id) $current = $priority;
                $priority--;
            }
            // This module was found
            if (!empty($current)) {
                if (($change == 'up') && ($current < $maxpriority)) {
                    $target = $current + 1;
                }
                if (($change == 'down') && ($current > 1)) {
                    $target = $current - 1;
                }
            }

            // Target module was found, exchange them
            if (!empty($target)) {
                $temp = $order[$target];
                $order[$target] = $order[$current];
                $order[$current] = $temp;

                $status = true;

                // Now re-assign priorities to all modules, if neceesary
                foreach($order as $priority => $module) {
                    if ($module->priority != $priority) {
                        $module->priority = $priority;
                        if (!$module->save()) {
                            $status = false;
                        }
                    }
                }
                return $status;
            }
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

    public static function getList($type, $exclude = array()) {
        $items = array();
        self::availableInit();
        foreach(self::$available[$type] as $code => $name) {
            if (in_array($code, $exclude)) continue;
            $item = new stdClass();
            $item->code = $code;
            $item->name = $name;
            $items[$item->code] = $item;
        }
        return $items;
    }

    public function isCompatible($versus) {
        if (empty($versus)) return Compatible::STATUS_UNKNOWN;
        return Compatible::isCompatible(
            array('licenseid' => $this->license_id,
                  'type'      => $this->type),
            array('licenseid' => $versus->license_id,
                  'type'      => $versus->type));
    }

    public function compatibility() {
        $global = Compatible::STATUS_COMPATIBLE;
        $compatibility = array(
            'status'    => Compatible::STATUS_COMPATIBLE,
            'conflicts' => array(),
        );
        if (!empty($this->project)) {
            $found = false;
            foreach ($this->project->modules as $module) {
                // First ignore any module until find me
                if (!$found && ($module->id != $this->id)) continue;
                if ($module->id == $this->id) {
                    $found = true;
                    continue;
                }

                // Check compatibility
                $status = $this->isCompatible($module);
                if ($status != Compatible::STATUS_COMPATIBLE) {
                    // Get worst compatibility status
                    if (($global == Compatible::STATUS_COMPATIBLE) ||
                        ($status == Compatible::STATUS_INCOMPATIBLE)) {
                        $global = $status;
                    }
                    $compatibility['conflicts'][$module->id] = array(
                        'versus' => $module,
                        'status' => $status);
                }
            }
            $compatibility['status'] = $global;
        }
        return $compatibility;
    }
}
