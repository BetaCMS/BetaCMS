<?php

$app = require('lib/base.php');
$app->set('DEBUG', 1);
if ((float)PCRE_VERSION < 7.9)
    trigger_error('PCRE version is out of date');

$app->config('app/config/default/config.ini');

$app->route('GET /',
    function ($app) {

        $app->set('hello', 'Hello World');
        echo View::instance()->render('default/index.htm');
    }
);


$app->run();
