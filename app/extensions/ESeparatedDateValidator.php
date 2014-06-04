<?php

class ESeparatedDateValidator extends CValidator {

    public $allowEmpty = array(
        'day'   => true,
        'month' => true,
        'year'  => true,
    );

    public $attrs = array(
        'day'   => 'day',
        'month' => 'month',
        'year'  => 'year',
    );

    public $limit = -1;

    /**
     * Validates the attribute of the object.
     * If there is any error, the error message is added to the object.
     * @param CModel $object the object being validated
     * @param string $attribute the attribute being validated
     */
    protected function validateAttribute($object, $attribute) {
        $attrDay   = $this->attrs['day'];
        $attrMonth = $this->attrs['month'];
        $attrYear  = $this->attrs['year'];
        $day       = $object->$attrDay;
        $month     = $object->$attrMonth;
        $year      = $object->$attrYear;
        if ($this->isEmpty($day)) {
            $day = 1;
            if (!$this->allowEmpty['day']) {
                $msg = Yii::t('app', 'Day can not be empty.');
                $this->addError($object, $attribute, $msg);
            }
        }
        if ($this->isEmpty($month)) {
            $month = 1;
            if (!$this->allowEmpty['month']) {
                $msg = Yii::t('app', 'Month can not be empty.');
                $this->addError($object, $attribute, $msg);
            }
        }
        if ($this->isEmpty($year)) {
            $year = (int) date('Y');
            if (!$this->allowEmpty['year']) {
                $msg = Yii::t('app', 'Year can not be empty.');
                $this->addError($object, $attribute, $msg);
            }
        }

        if ($this->validateValue($day, $month, $year) == false) {
            $msg = Yii::t('app','This is not a valid date.');
            $this->addError($object, $attribute, $msg);
        }
    }

    /**
     * Validates a static value to see if it is a valid URL.
     * Note that this method does not respect {@link allowEmpty} property.
     * This method is provided so that you can call it directly without going through the model validation rule mechanism.
     * @param string $value the value to be validated
     * @return mixed false if the the value is not a valid URL, otherwise the possibly modified value ({@see defaultScheme})
     * @since 1.1.1
     */
    public function validateValue($day, $month, $year) {
        $now = time();
        $timestamp = mktime(0, 0, 0, $month, $day, $year);
        if ($timestamp !== false) {
            if (($this->limit == 0) && ($timestamp > $now)) return false;
            if (($this->limit > 0) && ($timestamp > $this->limit)) return false;
        }
        return checkdate($month, $day, $year) ? $timestamp : false;
    }

}
