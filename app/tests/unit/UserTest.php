<?php

class UserTest extends CDbTestCase {

    static public $users = null;

    static public $fields= array(
    'user' => array (
            'public' => array('id', 'email', 'firstname', 'lastname', 'company', 'registerdate'),
            'private' => array('password', 'privileges', 'emailold', 'secret', 'secretdate',
                               'modifydate','lastaccess', 'deleted', 'confirmed', 'dontemailme'),
        ),
    );

    /**
    * GET user by id
    */
    public function testGetByIdUserExists() {

        $user = User::getById(1);
        $this->assertInstanceOf('User', $user, 'User exists');
    }
    public function testGetByIdUserNotExists() {

        $user = User::getById(15);
        $this->assertInstanceOf('User', $user, 'User does not exist');
    }
}


?>