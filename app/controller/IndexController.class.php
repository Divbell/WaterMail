<?php
/**
 * An IndexController
 */

class IndexController extends Controller
{
    public function indexAction()
    {
        echo "hello!";
        $this->render();
    }
}