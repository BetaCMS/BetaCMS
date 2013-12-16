<?php
namespace controllers;

/**
 * Index Controller Class
 */

class Test1 extends Base {

    public function __construct() {
        parent::__construct();
    }

    public function index($app, $params) {

        echo 'test1';
    }
}
