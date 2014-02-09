<?php
namespace admin;
/**
 * Index Controller Class
 */

class Options extends \Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($app, $params)
    {
        //\Options::instance()->index();
        $app->set('template','general');

        //echo $this->render('index.htm');
    }
}
