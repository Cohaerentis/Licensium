<?php

class ProjectTest extends CDbTestCase {

   public static $project = null;

    public function testCreateProject() {
        //Create a new project
        $project = new Project();
        $user_id = 2;

        //B. Save it without mandatory fields. This must fail; if it doesn't...
        $result = $project->save();
        $this->assertFalse($result);

        //C. Mandatory field added.
        $project->name = "ProjectoTest";
        $project->user_id = $user_id;
        $result = $project->save();
        $this->assertTrue($result);

        self::$project = $project;
    }

    /**
     * @depends testCreateProject
     */

    public function testGetById() {
        $item = self::$project;
        $this->assertNotNull($item);

        $project = Project::getById($item->id);
        $this->assertInstanceOf('Project', $project);
        $this->assertEquals($project->name, $item->name);
    }

     /**
     * @depends testCreateProject
     */

    public function testGetByUser() {
        $user_id = 2;
        $item = self::$project;
        $this->assertNotNull($item);
        $all = Project::getByUser($user_id);
        //total recorded +1 cause the one created is counted but deleted
        $this->assertGreaterThan(0, count($all));
    }

    /**
     * @depends testCreateProject
     */

    public function testDelete() {
        $item = self::$project;
        $this->assertNotNull($item, 'No item saved in "testCreate"');
        $id = $item->id;

        $result = $item->delete();
        $this->assertTrue($result);

        $item = User::getById($id);
        $this->assertNull($item);

    }
}