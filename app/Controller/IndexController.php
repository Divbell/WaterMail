<?php
/**
 * An IndexController
 */
namespace app\Controller;

use library\Controller as WebController;

class IndexController extends WebController
{
    public function indexAction()
    {
        echo "hello!";
//        $this->render();
    }
}