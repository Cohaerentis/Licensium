<?php
/**
 * global.php file.
 * Global shorthand functions for commonly used Yii methods.
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

defined('DS') or define('DS', DIRECTORY_SEPARATOR);

/**
 * Returns the application instance.
 * @return CWebApplication
 */
function app()
{
    return Yii::app();
}

/**
 * Returns the application parameter with the given name.
 * @param $name
 * @return mixed
 */
function param($name)
{
    return isset(Yii::app()->params[$name]) ? Yii::app()->params[$name] : null;
}

/**
 * Returns the client script instance.
 * @return CClientScript
 */
function cs()
{
    return Yii::app()->getClientScript();
}

/**
 * Returns the main database connection.
 * @return CDbConnection
 */
function db()
{
    return Yii::app()->getDb();
}

/**
 * Returns the formatter instance.
 * @return CFormat
 */
function format()
{
    return Yii::app()->getFormat();
}

/**
 * Returns the request instance.
 * @return CHttpRequest
 */
function request()
{
    return Yii::app()->getRequest();
}

/**
 * Returns the session instance.
 * @return CHttpSession
 */
function session()
{
    return Yii::app()->getSession();
}

/**
 * Returns the web user instance for the logged in user.
 * @return CWebUser
 */
function user()
{
    return Yii::app()->getUser();
}

/**
 * Translates the given string using Yii::t().
 * @param $category
 * @param $message
 * @param array $params
 * @param string $source
 * @param string $language
 * @return string
 */
function t($category, $message, $params = array(), $source = null, $language = null)
{
    return Yii::t($category, $message, $params, $source, $language);
}

/**
 * Returns the base URL for the given URL.
 * @param string $url
 * @return string
 */
function baseUrl($url = '')
{
    static $baseUrl;
    if (!isset($baseUrl))
        $baseUrl = Yii::app()->request->baseUrl;
    return $baseUrl . '/' . ltrim($url, '/');
}

/**
 * Registers the given CSS file.
 * @param $url
 * @param string $media
 */
function css($url, $media = '')
{
    Yii::app()->clientScript->registerCssFile(baseUrl($url), $media);
}

/**
 * Registers the given JavaScript file.
 * @param $url
 * @param null $position
 */
function js($url, $position = null)
{
    Yii::app()->clientScript->registerScriptFile(baseUrl($url), $position);
}

/**
 * Escapes the given string using CHtml::encode().
 * @param $text
 * @return string
 */
function e($text)
{
    return CHtml::encode($text);
}

function money($amount, $currency, $precision = 2) {
    $str = '';
    switch (strtoupper($currency)) {
        case 'EUR' :
        default:
            $str = number_format($amount, $precision, ',', '.') . ' €';
    }
    return e($str);
}

/**
 * Returns the escaped value of a model attribute.
 * @param $model
 * @param $attribute
 * @param null $defaultValue
 * @return string
 */
function v($model, $attribute, $defaultValue = null)
{
    return CHtml::encode(CHtml::value($model, $attribute, $defaultValue));
}

/**
 * Purifies the given HTML.
 * @param $text
 * @return string
 */
function purify($text)
{
    static $purifier;
    if (!isset($purifier))
        $purifier = new CHtmlPurifier;
    return $purifier->purify($text);
}

/**
 * Returns the given markdown text as purified HTML.
 * @param $text
 * @return string
 */
function markdown($text)
{
    static $parser;
    if (!isset($parser))
        $parser = new MarkdownParser;
    return $parser->safeTransform($text);
}

/**
 * Creates an image tag using CHtml::image().
 * @param $src
 * @param string $alt
 * @param array $htmlOptions
 * @return string
 */
function img($src, $alt = '', $htmlOptions = array())
{
    return CHtml::image(baseUrl($src), $alt, $htmlOptions);
}

/**
 * Creates a link to the given url using CHtml::link().
 * @param $text
 * @param string $url
 * @param array $htmlOptions
 * @return string
 */
function l($text, $url = '#', $htmlOptions = array())
{
    return CHtml::link($text, $url, $htmlOptions);
}

/**
 * Creates a relative URL using CUrlManager::createUrl().
 * @param $route
 * @param array $params
 * @param string $ampersand
 * @return mixed
 */
function url($route, $params = array(), $ampersand = '&')
{
    return Yii::app()->urlManager->createUrl($route, $params, $ampersand);
}

/**
 * Encodes the given object using json_encode().
 * @param mixed $value
 * @param integer $options
 * @return string
 */
function je($value, $options = 0)
{
    return json_encode($value, $options);
}

/**
 * Decodes the given JSON string using json_decode().
 * @param $string
 * @param boolean $assoc
 * @param integer $depth
 * @param integer $options
 * @return mixed
 */
function jd($string, $assoc = true, $depth = 512, $options = 0)
{
    return json_decode($string, $assoc, $depth, $options);
}

/**
 * Dumps the given variable using CVarDumper::dumpAsString().
 * @param mixed $var
 * @param int $depth
 * @param bool $highlight
 */
function dump($var, $depth = 10, $highlight = true)
{
    echo CVarDumper::dumpAsString($var, $depth, $highlight);
}

function parse_args( $args, $defaults = '' ) {
    if ( is_object( $args ) )
        $r = get_object_vars( $args );
    elseif ( is_array( $args ) )
        $r =& $args;
    else
        alt_parse_str( $args, $r );

    if ( is_array( $defaults ) )
        return array_merge( $defaults, $r );
    return $r;
}

function alt_parse_str( $string, &$array ) {
    parse_str( $string, $array );
    if ( get_magic_quotes_gpc() ) $array = stripslashes_deep( $array );
}

function stripslashes_deep($value) {
    if ( is_array($value) ) {
        $value = array_map('stripslashes_deep', $value);
    } elseif ( is_object($value) ) {
        $vars = get_object_vars( $value );
        foreach ($vars as $key=>$data) {
            $value->{$key} = stripslashes_deep( $data );
        }
    } elseif ( is_string( $value ) ) {
        $value = stripslashes($value);
    }

    return $value;
}

function randomString($length = 10, $alphabet = null) {
    if (empty($alphabet)) {
        $alphabet = array_merge(
            range('2', '7'), array('9'),
            range('a', 'h'), array('j', 'k'), range('p', 'z'),
            array('A', 'C'), range('E', 'H'), range('J', 'N'), array('P'), range('R', 'Z'));
    }
    $count = count($alphabet);
    $rand = '';
    for ($i = 0; $i < $length; $i++) {
        $rand .= $alphabet[mt_rand(0, $count - 1)];
    }
    return $rand;
}
