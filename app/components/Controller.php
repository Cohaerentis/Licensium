<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {
    const PRIVILEGE_USER  = 0;
    const PRIVILEGE_ADMIN = 10;

    const PAGE_DEFAULT               = 1;
    const PAGESIZE_DEFAULT           = 10;
    const PAGESIZE_MAX               = 100;

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '/layouts/main';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs=array();

    public static function paginationNormalize($page, $pagesize) {
        $page = (is_numeric($page)) ? (int) $page : self::PAGE_DEFAULT;
        $page = ($page >= 1) ? $page : self::PAGE_DEFAULT;
        $pagesize = (is_numeric($pagesize)) ? (int) $pagesize : self::PAGESIZE_DEFAULT;
        $pagesize = ($pagesize >= 1) ? $pagesize : self::PAGESIZE_DEFAULT;
        $pagesize = ($pagesize > self::PAGESIZE_MAX) ? self::PAGESIZE_MAX : $pagesize;
        $limit = $pagesize + 1; // Always get one more, in order to known if there more items
        $offset = $pagesize * ($page - 1);

        return array($page, $pagesize, $limit, $offset);
    }

    public function renderAjaxHtml($view, $data = array(), $return = false) {
        $this->layout = '/layouts/ajax-html';
        $this->render($view, $data, $return);
        Yii::app()->end();
    }

    public function renderAjaxError($error = '', $return = false) {
        $this->layout = '/layouts/ajax-error';
        $this->render('/ajax/error', array('error' => $error), $return);
        Yii::app()->end();
    }

    public function renderAjaxRedirect($uri = '/', $return = false) {
        $this->layout = '/layouts/ajax-redirect';
        $this->render('/ajax/redirect', array('redirect' => $uri), $return);
        Yii::app()->end();
    }

    public function renderAjaxJson($json = null, $return = false) {
        $this->layout = '/layouts/ajax-json';
        $this->render('/ajax/json', array('json' => $json), $return);
        Yii::app()->end();
    }
}