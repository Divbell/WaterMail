<?php
/**
 * Autoloader and helpful, shared functions
 */

use library;

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

setReporting();
removeMagicQuotes();
unregisterGlobals();