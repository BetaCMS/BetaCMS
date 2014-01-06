<?php
namespace admin;
/**
 * Index Controller Class
 */

class Index extends \Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($app, $params)
    {
        echo $this->render('index.htm');
    }
}
