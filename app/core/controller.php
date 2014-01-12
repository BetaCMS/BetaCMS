<?php
/**
 * Base Controller Class
 *
 */

abstract class Controller extends \Prefab
{

    /**
     * instance
     *
     * @var app
     */
    protected $app;

    /**
     * logger instance
     *
     * @var logger
     */
    protected $logger;


    /**
     * initialize controller
     *
     */
    public function __construct()
    {
        $this->app = \Base::instance();
        $this->logger = \Registry::get('logger');
    }


    function beforeroute($app, $url)
    {
        if (!empty($url) && preg_match('/^\/admin\/?/', $url[0])) {
            $this->app->set('theme', 'admin');
        }
        $theme = trim($app->get('theme'), '/');
        $themes = "{$app->get('site')}/themes/$theme";
        $app->set('themes', $themes);
        $app->set('UI', "../$themes/");
    }


    function afterroute($app, $url)
    {
        if (!empty($url) && preg_match('/^\/admin\/?/', $url[0])) {
            echo Template::instance()->render('layout.htm');
        } else {
            echo Template::instance()->render('index.htm');
        }
    }
}
