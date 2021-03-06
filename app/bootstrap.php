<?php
namespace application;

define('ROOT', realpath('../'));

$app = require_once('lib/base.php');
// read config and overrides
// @see http://fatfreeframework.com/framework-variables#configuration-files
$app->config('config/default.ini');
if (file_exists('config/config.ini'))
    $app->config('config/config.ini');

// setup class autoloader
// @see http://fatfreeframework.com/quick-reference#autoload
$app->set('AUTOLOAD', __dir__ . '/|controllers/|models/|core/');

//创建用户文件夹
if (!$site = trim($app->get('site'), '/')) {
    $site = 'site';
    $app->set('site', $site);
    if (!is_dir(ROOT . '/' . $site))
        mkdir(ROOT . '/' . $site, $app::MODE, TRUE);
} else {
    $app->set('site', trim($app->get('site'), '/'));
}

if (!$admin = $app->get('admin')) {
    $admin = 'admin';
    $app->set('admin', $admin);
}

$themes = "{$app->get('site')}/themes/" . trim($app->get('theme'), '/');
$app->set('themes', "{$app->get('BASE')}/$themes");
$app->set('UI', ROOT . "/$themes/");

$app->set('TEMP', "../$site/{$app->get('TEMP')}");

// custom error handler if debugging
$debug = $app->get('DEBUG');
// default error pages if site is not being debugged
if (true||PHP_SAPI !== 'cli' && empty($debug)) {
    $app->set('ONERROR',
        function () use ($app) {
            header('Expires:  ' . \helpers\time::http(time() + $app->get('error.ttl')));
            $template = 'error/500.html';
            if ($app->get('ERROR.code') == '404') {
                $app->status(200);
                $template = 'error/404.html';
            }
            echo \Template::instance()->render($template);
        }
    );
}

// setup application logging
$logger = new \Log(date("Y-m-d") . '.log');
\Registry::set('logger', $logger);

// setup database connection params
// @see http://fatfreeframework.com/databases
if ($app->get('db.driver') == 'sqlite') {

    $dsn = $app->get('db.dsn');
    $dfile = ROOT . '/' . $site . substr($dsn, strpos($dsn, '/'));
    if (!file_exists($dfile)) {
        die('<h1>无数据库!</h1>');
    }
    $dsn = substr($dsn, 0, strpos($dsn, '/')) . $dfile;
    $db = new \DB\SQL($dsn);
} else {
    if (!$app->get('db.dsn')) {
        $app->set('db.dsn', sprintf(" % s:host =%s;port =%d;dbname =%s",
                $app->get('db.driver'), $app->get('db.hostname'), $app->get('db.port'), $app->get('db.name'))
        );
    }
    $db = new \DB\SQL($app->get('db.dsn'), $app->get('db.username'), $app->get('db.password'));
}
\Registry::set('db', $db);


// setup outgoing email server for php mail command
ini_set("SMTP", $app->get('email.host'));
ini_set('sendmail_from', $app->get('email.from'));

// If in CLI mode run that from here on...
if (PHP_SAPI == 'cli') {
    require_once 'bootstrap-cli.php';
    exit;
}

// command line does not have SESSIONs so can't use SESSION notifications
// setup user notifications
// @see https://github.com/needim/noty for a library to present the messages
$notifications = $app->get('session.notifications');
if (!$app->exists('SESSION.notifications')) {
    $app->set('SESSION.notifications', array(
        'alert' => array(),
        'error' => array(),
        'warning' => array(),
        'success' => array(),
        'information' => array(),
        'confirmation' => array(),
    ));
}


// setup routes
// @see http://fatfreeframework.com/routing-engine
// firstly load routes from ini file
//$app->config('config/routes.ini');
$app->route('GET /', 'index->index');
$app->route('GET /*/@controller', '@controller->index');
$app->route('GET /*/@controller/@action', '@controller->@action');


/*admin*/
$app->route('GET /*' . $admin, 'admin\dashboard->index');
$app->route('GET /*' . $admin . '/@controller', 'admin\@controller->index');
$app->route('GET|POST /*' . $admin . '/@controller/@action', 'admin\@controller->action');
$app->route('GET|POST /*' . $admin . '/@controller/@action/@slug', 'admin\@controller->action');


// object mode
/*$app->route('GET /admin', 'admin\index->index');
$app->route('GET /admin/@action', 'admin\@action->index');*/
/*$app->route('GET /admin/@controller/@action', 'admin\@controller->@action');

$app->route('GET /@controller/@action', '@controller->@action');*/


$app->run();

// clear the SESSION messages unless 'keep_notifications' is not false
if ($app->get('keep_notifications') === false) {
    $app->set('SESSION.notifications', null);
}

// log script execution time if debugging
if ($debug || $app->get('app.environment') == 'development') {
    // log database transactions if level 3
    if ($debug == 3) {
        $logger->write(\Registry::get('db')->log());
    }
    $execution_time = round(microtime(true) - $app->get('TIME'), 3);
    $logger->write('Script executed in ' . $execution_time . ' seconds using ' . round(memory_get_usage() / 1024 / 1024, 2) . '/' . round(memory_get_peak_usage() / 1024 / 1024, 2) . ' MB memory/peak');
}
