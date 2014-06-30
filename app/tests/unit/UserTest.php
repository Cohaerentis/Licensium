<?php

class UserTest extends CDbTestCase {
    public static $user = null;

    public function testCreate() {
        $user = new User();
        //Firstname not mandatory but used to check save() action */
        $user->firstname = 'Abraham';
        $user->lastname = 'Aranda';

        // A. Check save fails, because email is mandatory
        $result = $user->save();
        $this->assertFalse($result, 'Parece que te lo está guardando sin los campos obligatorios');
        $errors = $user->getErrors();
        $this->assertArrayHasKey('email', $errors);

        $random = rand();
        $user->email = "test+$random@midomain.com";
        $user->password = "123456aS*";
        //$user->password = hash("123456aS*");
        $user->privacy = 1;

        // B. Check save is OK
        $result = $user->save();
        $this->assertTrue($result, 'No te está guardando nada; por eso te da error');
        $this->assertGreaterThan(0, $user->id);

        self::$user = $user;
    }

    /**
     * @depends testCreate
     */
    public function testGetById() {
        $item = self::$user;
        $this->assertNotNull($item, 'No item saved in "testCreate"');

        $user = User::getById($item->id);
        $this->assertInstanceOf('User', $user);
        $this->assertEquals($user->email, $item->email);
    }

     /**
     * @depends testCreate
     */
    public function testEmailConfirm() {
        $item = self::$user;

        //A. Check if the user has confirmed his email
        $this->assertEquals(0, $item->confirmed);

        //B. Confirm email and save
        $item->confirmed = 1;
        $confirmed = $item->save();
        $this->assertTrue($confirmed);
    }

    /**
     * @depends testCreate
     */
    public function testPasswordChange() {
        $item = self::$user;

        $old_password = $item->password;
        $random = rand();

        // A. Set a new password to the created user
        $new_password = $item->passwordChange($random);
        $new_password = $item ->save();

        //B. Check if its has been saved correctly;
        $this->assertTrue($new_password);
        $this->assertNotEquals($new_password, $old_password);

        //C. Check if the password has been hashed correctly
        $this->assertNotEquals($random, $item->password);
    }

     /**
     * @depends testCreate
     */
    public function testEmailChange() {
        $item = self::$user;
        $old_email = $item->email;

        //A. Set a new email
        $new_email = $item->emailChange("my_new_mail@licensium.es");
        $new_email = $item->save();

        //B. Check if the email has been saved correctly
        $this->assertTrue($new_email);
        $this->assertNotEquals($item->email,$old_email);

    }

    /**
     * @depends testCreate
     */
    public function testDelete() {
        $item = self::$user;
        $this->assertNotNull($item, 'No item saved in "testCreate"');
        $id = $item->id;

        $result = $item->delete();
        $this->assertTrue($result);

        $user = User::getById($id);
        $this->assertNull($user);

    }

}