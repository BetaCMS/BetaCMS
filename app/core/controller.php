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


    /**
     * render view
     * @return string
     * @param $view string
     *
     */
    public function render($view)
    {
        return \View::instance()->render(($this->app->exists('theme') ? trim($this->app->get('theme'), '/') . '/' : '') . $view);
    }
}
