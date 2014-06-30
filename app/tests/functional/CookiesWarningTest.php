<?php
class CookiesWarningTest extends WebTestCase {

    private function cookiesWarningShow($url) {
        $this->url($url);
        // Wait for cookies warning modal appears
        sleep(0.5);
        $this->assertElementExistsById('cookies-modal');
    }

    private function cookiesWarningNotShow($url) {
        $this->url($url);
        // Wait for cookies warning modal appears, if any
        sleep(0.5);
        $this->assertElementNotExistsById('cookies-modal');
    }

    private function acceptCookies() {
        $modals = $this->elements($this->using('id')->value('cookies-modal'));
        if (!empty($modals)) {
            // Wait for cookies warning modal appears
            sleep(1);
            $this->clickOnElement('btn-cookies-modal-ok');
        }
    }

/* */
    // Pages where cookies warning must be shown
    public function testWarning() {
        $yes = array(
            '',
            'user/login',
            'user/signup',
            'site/page/view/about',
            'site/page/view/goal',
            'site/page/view/entities',
            'site/page/view/how-do-we',
            'site/page/view/propietary',
            'site/page/view/public-domain',
            'site/page/view/page-not-found',
        );
        $no = array(
            'site/page/view/cookies-policy',
            'site/page/view/legal',
            'site/page/view/privacy-policy',
        );
        $this->cookiesWarningShow('site/page/view/goal');
        $this->cookiesWarningShow('site/page/view/entities');
        $this->cookiesWarningShow('site/page/view/how-do-we');
        $this->cookiesWarningShow('site/page/view/propietary');
        $this->cookiesWarningShow('site/page/view/public-domain');

        // Project report
        $projects = Project::model()->findAll();
        if (!empty($projects)) {
            $project = current($projects);
            $yes[] = "project/report/id/{$project->id}/code/{$project->uuid}";
        }

        // User error pages
        $users = User::model()->findAll('confirmed = 1');
        if (!empty($users)) {
            $user = current($users);
            // 500 : Error generating confirmation code
            $yes[] = "user/resend/{$user->id}";
            // 400 : Invalid request
            $yes[] = "user/confirm/{$user->id}";
            // 401 : Invalid confirm code
            $yes[] = "user/confirm/{$user->id}?code=" . rand();
        }

        // A. Warning must appears
        foreach($yes as $url) $this->cookiesWarningShow($url);
        // B. Warning must not appears
        foreach($no as $url) $this->cookiesWarningNotShow($url);
        // C. Warning must not appears, after cookies accepted
        $this->url(current($yes));
        $this->acceptCookies();
        foreach($yes as $url) $this->cookiesWarningNotShow($url);
    }

/* */
    public function setUp() {
        parent::setUp();
    }

    public function tearDown() {
        parent::tearDown();
    }

}

