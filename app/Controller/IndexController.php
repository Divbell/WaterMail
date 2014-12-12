<?php
/**
 * An IndexController
 */
namespace app\Controller;

use library\MVC\Controller as WebController;

class IndexController extends WebController
{
    public function indexAction()
    {
        $this->render();
    }
}