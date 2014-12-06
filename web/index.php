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

$FrontController = new library\FrontController();
$FrontController->run();