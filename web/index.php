<?php
/**
 * Watermail - a simple email client
 *
 * @author Michał Huras
 * @copyright 2014 Michał Huras
 */

error_reporting(E_ALL);

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('LIBRARY', ROOT . DS . 'library');
define('APP', ROOT . DS . 'app');

$url = $_GET['url'];

require_once(LIBRARY . DS . 'bootstrap.php');