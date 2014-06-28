<?php
class UserControllerTest extends WebTestCase {
    public static $user = null;

    private function acceptCookies() {
        $modals = $this->elements($this->using('id')->value('cookies-modal'));
        if (!empty($modals)) {
            // Wait for cookies warning modal appears
            sleep(1);
            $this->clickOnElement('btn-cookies-modal-ok');
        }
    }

    private function login() {
        $this->url('user/login');
        $this->acceptCookies();

        // A. Login Form
        $this->assertEquals('Licensium - Login', $this->title());
        $this->assertElementExistsById('link-login');
        $this->assertElementExistsById('link-signup');

        // Check form fields
        $this->assertElementExistsById('LoginForm_email');
        $this->assertElementExistsById('LoginForm_password');
        $this->assertElementExistsById('btn-login');

        // Fill form
        $this->byId('LoginForm_email')->value(self::$user['email']);
        $this->byId('LoginForm_password')->value(self::$user['password']);

        // Submit form
        $this->clickOnElement('btn-login');

        // B. Any page with loggedin header
        $this->assertElementExistsById('link-profile');
        $this->assertElementExistsById('link-logout');
    }

/* */
    public function testSignup() {
        $this->url('user/signup');
        $this->acceptCookies();

        // A. SignUp Form
        $this->assertEquals('Licensium - Registry Form', $this->title());

        // Check form fields
        $this->assertElementExistsById('User_email');
        $this->assertElementExistsById('User_password');
        $this->assertElementExistsById('User_firstname');
        $this->assertElementExistsById('User_lastname');
        $this->assertElementExistsById('User_company');
        $this->assertElementExistsById('User_privacy');
        $this->assertElementExistsById('btn-signup');

        // Fill form
        $number = rand();
        self::$user['email'] = "test-{$number}@test.com";
        $this->byId('User_email')->value(self::$user['email']);
        self::$user['password'] = 'mypassword';
        $this->byId('User_password')->value(self::$user['password']);
        self::$user['firstname'] = "Name $number";
        $this->byId('User_firstname')->value(self::$user['firstname']);
        self::$user['lastname'] = "LastName $number";
        $this->byId('User_lastname')->value(self::$user['lastname']);
        self::$user['company'] = "Company $number";
        $this->byId('User_company')->value(self::$user['company']);
        $this->clickOnElement('User_privacy');

        // Submit form
        $this->clickOnElement('btn-signup');

        // B. Confirmation email sent
        $this->assertEquals('Licensium - Registry completed', $this->title());

        // Save confirmation link for testLoginAndConfirm
        self::$user['confirmlink'] = $this->byId('test-confirm-link')->attribute('href');
    }

    /**
     * @depends testSignup
     */
/* */
    public function testLoginAndConfirm() {
        $this->login();
        // A. Resend confirmation link appears, because we are not confirmed yet
        $this->assertElementExistsById('link-confirm-resend');

        // Go to confirmation link
        $this->url(self::$user['confirmlink']);

        // B. Email confirmed
        $this->assertEquals('Licensium - Email Confirmation Complete', $this->title());
    }

    /**
     * @depends testLoginAndConfirm
     */
/* */
    public function testLogin() {
        $this->login();
        // A. Resend confirmation link does not appear, we are already confirmed
        $this->assertElementNotExistsById('link-confirm-resend');
    }

    /**
     * @depends testLoginAndConfirm
     */
/* */
    public function testRemember() {
        $this->url('user/remember');
        $this->acceptCookies();

        // A. Remember Form
        $this->assertEquals('Licensium - Forgot your password', $this->title());

        // Check we are not loggedin
        $this->assertElementExistsById('link-login');
        $this->assertElementExistsById('link-signup');

        // Check form fields
        $this->assertElementExistsById('RememberForm_email');
        $this->assertElementExistsById('btn-remember');

        // Fill form
        $this->byId('RememberForm_email')->value(self::$user['email']);

        // Submit form
        $this->clickOnElement('btn-remember');

        // B. Remember email sent
        $this->assertEquals('Licensium - Email sent', $this->title());
        $this->assertElementExistsById('test-remember-link');

        // Click on remember link
        $this->clickOnElement('test-remember-link');

        // C. Password change form
        $this->assertEquals('Licensium - Change your password', $this->title());

        // Check form fields
        $this->assertElementExistsById('PasswordForm_password');
        $this->assertElementExistsById('PasswordForm_repassword');
        $this->assertElementExistsById('btn-password-change');

        // Fill form
        self::$user['password'] = 'newpassword';
        $this->byId('PasswordForm_password')->value(self::$user['password']);
        $this->byId('PasswordForm_repassword')->value(self::$user['password']);

        // Submit form
        $this->clickOnElement('btn-password-change');

        // D. Password changed
        $this->assertEquals('Licensium - Password changed', $this->title());

    }

/* */
    public function setUp() {
        parent::setUp();
    }

    public function tearDown() {
        parent::tearDown();
    }

}

