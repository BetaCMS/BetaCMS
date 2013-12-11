<?php
$app = require('system/lib/base.php');
if ((float)PCRE_VERSION < 7.9)
    trigger_error('PCRE version is out of date');

$app->config('app/config/config.ini');

$app->route('GET /',
    function ($app) {
        $logger = new Log('error.log');
        $logger->write('ttttttttttt');

        $app->set('hello', 'Hello World!');
        echo View::instance()->render('default/index.htm');
    }
);


$app->run();
