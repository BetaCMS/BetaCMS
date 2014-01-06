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


        echo var_dump($url);
        echo var_dump($url);
    }


    /**
     * render view
     * @return string
     * @param $view string
     *
     */
    public function render($view)
    {
        return \Template::instance()->render(($this->app->exists('theme') ? trim($this->app->get('theme'), '/') . '/' : '') . $view);
    }
}
