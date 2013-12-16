<?php
namespace controllers;
/**
 * Index Controller Class
 */

class Index extends Base
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($app, $params)
    {
       \models\Index::instance()->index();


        echo \View::instance()->render('default/index.htm');
    }
}
