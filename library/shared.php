<?php
/**
 * Autoloader and helpful, shared functions
 */

/** Check active environment - if it's development mode, display errors **/
function setReporting()
{
    if(DEVELOPMENT_ENVIRONMENT == true) {
        error_reporting(E_ALL);
        ini_set('display_errors', 'on');
    } else {
        error_reporting(E_ALL);
        ini_set('display_errors', 'off');
        ini_set('log_errors', 'on');
        ini_set('error_log', ROOT . DS . 'tmp' . DS . 'logs' . DS . 'errors.log');
    }
}

/** Check for Magic Quotes and remove them  **/

function stripSlashesDeep($value)
{
    $value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
    return $value;
}

function removeMagicQuotes()
{
    if(get_magic_quotes_gpc()) {
        $_GET       = stripSlashesDeep($_GET);
        $_POST      = stripSlashesDeep($_POST);
        $_COOKIE    = stripSlashesDeep($_COOKIE);
    }
}

function unregisterGlobals()
{
    if(ini_get('register_globals')) {
        $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
        foreach($array as $value)
            foreach($GLOBALS[$value] as $key => $var)
                if($var === $GLOBALS[$key]) unset($GLOBALS[$key]);
    }
}

function callHook()
{
    global $url;

    $urlArray = array();
    $urlArray = explode("/", $url);

    $controller = $urlArray[0];
    array_shift($urlArray);
    $action = $urlArray[0];
    array_shift($urlArray);
    $queryString = $urlArray;

    $controllerName = $controller;
    $controller = ucwords($controller);
    $model = rtrim($controller, 's');
    $controller .= 'Controller';

    $dispatch = new $controller($model, $controllerName, $action);

    if((int)method_exists($controller, $action)) call_user_func_array(array($dispatch, $action), $queryString);
    else throw new Exception("An action like that one doesn't exists!");
}

function __autoload($className)
{
    if(file_exists(LIBRARY . DS . strtolower($className) . '.class.php'))
        require_once(LIBRARY . DS . strtolower($className) . '.class.php');
    else if(file_exists(APP . DS . 'controller' . DS . $className . '.class.php'))
        require_once(APP . DS . 'controller' . DS . $className . '.class.php');
    else if(file_exists(APP . DS . 'model' . DS . strtolower($className) . '.class.php'))
        require_once(APP . DS . 'model' . DS . strtolower($className) . '.class.php');
    else throw new Exception("This file doesn't exists!");
}

setReporting();
removeMagicQuotes();
unregisterGlobals();
callHook();