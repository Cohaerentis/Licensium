<?php

/**
 * The base class for functional test cases.
 * In this class, we set the base URL for the test application.
 * We also provide some common methods to be used by concrete test classes.
 */
class WebTestCase extends EFuntionalTestCase {

    public function assertElementExistsById($id) {
        $elements = $this->elements($this->using('id')->value($id));
        $this->assertCount(1, $elements, "Element ID = $id does not exists");
    }

    public function assertElementNotExistsById($id) {
        $elements = $this->elements($this->using('id')->value($id));
        $n = count($elements);
        $this->assertCount(0, $elements, "Element ID = $id exists $n times");
    }

    /**
     * Sets up before each test method runs.
     * This mainly sets the base URL for the test application.
     */
    protected function setUp() {
        parent::setUp();
        $this->setHost(Yii::app()->params['selenium']['host']);
        $this->setBrowser(Yii::app()->params['selenium']['browser']);
        $this->setBrowserUrl(Yii::app()->params['selenium']['baseurl']);
    }
}
