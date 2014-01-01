<?php
/**
 * Index Controller Class
 */

class Index extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($app, $params)
    {
        User::instance()->index();
        echo $this->render('index.htm');
    }
}
