<?php
if (empty($app)) {
    die("Run bootstrap.php to include this file cli.php!\n");
}
if (PHP_SAPI != 'cli') {
    die("This must be run from the command line!\n");
}

$app->run();

if ($debug || $app->get('app.environment') == 'development') {
    // log database transactions if level 3
    if ($debug == 3) {
        $logger->write(\Registry::get('db')->log());
    }
    $execution_time = round(microtime(true) - $app->get('TIME'), 3);
    $logger->write('Script executed in ' . $execution_time . ' seconds using ' . round(memory_get_usage() / 1024 / 1024, 2) . '/' . round(memory_get_peak_usage() / 1024 / 1024, 2) . ' MB memory/peak');
}
