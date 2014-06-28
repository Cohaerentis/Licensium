<?php
class CookiesWarningTest extends WebTestCase {

    private function cookiesWarningShow($url) {
        $this->url($url);
        $this->assertElementExistsById('cookies-modal');
    }

    private function cookiesWarningNotShow($url) {
        $this->url($url);
        $this->assertElementNotExistsById('cookies-modal');
    }
/* * /
    // Pages where cookies warning must be shown
    public function testHome() { $this->cookiesWarningShow(''); }
    public function testUserLogin() { $this->cookiesWarningShow('user/login'); }
    public function testUserSignup() { $this->cookiesWarningShow('user/signup'); }
    public function testPageAbout() { $this->cookiesWarningShow('site/page/view/about'); }
    public function testPageGoal() { $this->cookiesWarningShow('site/page/view/goal'); }
    public function testPageEntities() { $this->cookiesWarningShow('site/page/view/entities'); }
    public function testPageHowdowe() { $this->cookiesWarningShow('site/page/view/how-do-we'); }
    public function testLicensePropietary() { $this->cookiesWarningShow('site/page/view/propietary'); }
    public function testLicensePublicDomain() { $this->cookiesWarningShow('site/page/view/public-domain'); }
    public function testErrorNotFound() { $this->cookiesWarningShow('site/page/view/page-not-found'); }
    public function testLicensiumReport() { $this->cookiesWarningShow('project/report/id/1/code/e6f24995-179e-4583-afc2-6a5cdef88e0e'); }

    // Pages where cookies warning must not be shown
    public function testPageCookiesPolicy() { $this->cookiesWarningNotShow('site/page/view/cookies-policy'); }
    public function testPageLegal() { $this->cookiesWarningNotShow('site/page/view/legal'); }
    public function testPagePrivacyPolicy() { $this->cookiesWarningNotShow('site/page/view/privacy-policy'); }

/* */
    public function setUp() {
        parent::setUp();
    }

    public function tearDown() {
        parent::tearDown();
    }

}

