<?php
/**
 * Assets class file.
 * @author Antonio Espinosa <aespinosa@teachnova.com>
 * @copyright Copyright &copy; Antonio Espinosa 2014-
 * @license http://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3
 * @package components
 * @version 0.0.1
 */

class Assets extends CApplicationComponent {
    /**
     * @var bool whether we should copy the asset file or directory even if it is already published before.
     */
    public $forceCopyAssets = YII_DEBUG;

    // getUrl()
    //    return the URL for this module's assets, performing the publish operation
    //    the first time, and caching the result for subsequent use.
    private $_url;

    public function getUrl() {
        if (isset($this->_url)) {
            return $this->_url;
        } else {
            $assetsPath = Yii::getPathOfAlias('application.assets');
            $assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, 2, $this->forceCopyAssets);
            return $this->_url = $assetsUrl;
        }
    }

    /**
     * Registers Custom CSS.
     * @param string $url the URL to the CSS file to register.
     */
    public function registerCss($url = null) {
        if ($url === null) {
            $fileName = YII_DEBUG ? 'main.css' : 'main.min.css';
            $url = $this->getUrl() . '/css/' . $fileName;
        }
        /** @var CClientScript $cs */
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile($url);
    }

    /**
     * Registers Custom JavaScript.
     * @param string $url the URL to the JavaScript file to register.
     * @param int $position the position of the JavaScript code.
     */
    public function registerScripts() {
        $scripts = array('jquery-1.10.2' => CClientScript::POS_HEAD,
                         'modernizr-2.7.0' => CClientScript::POS_END,
                         'jquery-form-3.50.0' => CClientScript::POS_END,
                         'jquery-chosen-1.1.0' => CClientScript::POS_END);
        if (YII_DEBUG) {
            // $scripts['bootstrap/affix'] = CClientScript::POS_END;
            $scripts['bootstrap/alert'] = CClientScript::POS_END;
            $scripts['bootstrap/button'] = CClientScript::POS_END;
            // $scripts['bootstrap/carousel'] = CClientScript::POS_END;
            $scripts['bootstrap/collapse'] = CClientScript::POS_END;
            $scripts['bootstrap/dropdown'] = CClientScript::POS_END;
            $scripts['bootstrap/modal'] = CClientScript::POS_END;
            // $scripts['bootstrap/popover'] = CClientScript::POS_END;
            // $scripts['bootstrap/scrollspy'] = CClientScript::POS_END;
            // $scripts['bootstrap/tab'] = CClientScript::POS_END;
            // $scripts['bootstrap/tooltip'] = CClientScript::POS_END;
            $scripts['bootstrap/transition'] = CClientScript::POS_END;
            $scripts['jquery-crud'] = CClientScript::POS_END;
            $scripts['jquery-selectchange'] = CClientScript::POS_END;
        }
        $scripts['app'] = CClientScript::POS_END;
        $cs = Yii::app()->getClientScript();
        foreach ($scripts as $script => $position) {
            $script .= YII_DEBUG ? '.js' : '.min.js';
            $url = $this->getUrl() . '/js/' . $script;
            $cs->registerScriptFile($url, $position);
        }
    }

}