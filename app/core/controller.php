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
        $base = $app->get('BASE');
        $app->set('admintheme', "$base/{$app->get('site')}/themes/admin");
        $app->set('themes', "$base/{$app->get('site')}/themes/{$app->get('theme')}");
        if (!empty($url) && preg_match('/^\/admin\/?/', $url[0])) {
            $this->app->set('theme', 'admin');
        }
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
