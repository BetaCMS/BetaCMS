<?php
namespace admin;
/**
 * Index Controller Class
 */

class Dashboard extends \Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($app, $params)
    {
        //\Options::instance()->index();
        $app->set('template','dashboard');

        //echo $this->render('index.htm');
    }
}
