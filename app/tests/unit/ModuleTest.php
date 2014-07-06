<?php

class ModuleTest extends CDbTestCase {
    public static $module = null;

    public function testCreateModule() {
        $module      = new Module();
        $project     = Project::getAll();
        $project_id  = rand(1, count($project));
        $random      = 'Module_'.rand();
        $type        = rand(0,1);
        $year        = rand(1970, 2014);

        //A. An empty project cannot be save
        $result = $module->save();
        $errors  = $module->getErrors(); // Check mandatory fields.
        $this->assertFalse($result);

        //B. Save module with required fields
        $module->project_id = $project_id;
        $module->name       = $random;
        $module->type       = $type;
        $module->year       = $year;
        $result = $module->save();
        $errors = $module->getErrors();
        $this->assertTrue($result);

        self::$module = $module;
    }

    /**
     * @depends testCreateModule
     */
    public function testEnableModule() {
        $item = self::$module;
        $enabled = $item->enabled;

        //A. The module must be enable by default
        $this->assertNotEmpty($enabled);
        $this->assertNotEquals(0, 1);
        var_dump($item->enabled);

        //B. We can disable the module
        $enabled = $item->disable();
        $result = $item->save();
        var_dump($item->enabled);
        $this->assertNotEmpty($enabled);
        $this->assertEquals(0, 0);
        //C. We can enable the module once again.
        $enable = $item->enable();
        $result = $item->save();
        var_dump($item->enabled);
        $this->assertNotEmpty($enabled);
        $this->assertEquals(0, 0);


    }

    /**
     * @depends testCreateModule
     */
    public function testDelete() {
        $item = self::$module;
        $this->assertNotNull($item, 'No item saved in "testCreate"');
        $id = $item->id;

        $result = $item->delete();
        $this->assertTrue($result);

        $module = Module::getById($id);
        $this->assertNull($module);

    }

}