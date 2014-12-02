<?php
/**
 * Watermail - a simple email client
 *
 * @author Michał Huras
 * @copyright 2014 Michał Huras
 */

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('LIBRARY', ROOT . DS . 'library');
define('APP', ROOT . DS . 'app');

require_once(LIBRARY . DS . 'Autoloader.php');

$autoloader = library\Autoloader::getInstance();

$url = $_GET['url'];

$router = new library\Router($url);

$router->getRoute();
$router->dispatch();