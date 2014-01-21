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
        if (!empty($url) && preg_match('/\/admin\/?/', $url[0])) {
            $app->set('theme', 'admin');
        }
        //根据url获取使用的语言
        if ($lan = strtolower(preg_replace('/^\/([a-zA-Z]*)\/?.*/', '${1}', $url[0]))) {
            if (!stripos($app->get('LANGUAGE'), $lan) === false) {
                $app->set('FALLBACK', $lan);
            }
        }
        $themes = "{$app->get('site')}/themes/" . trim($app->get('theme'), '/');
        $app->set('themes', "{$app->get('BASE')}/$themes");
        $app->set('UI', ROOT . "/$themes/");
    }


    function afterroute($app, $url)
    {
        /*后端模板逻辑*/
        if (!empty($url) && preg_match('/\/admin\/?/', $url[0])) {
            if ($app->get('AJAX')) {
                if ($template = $app->get('template'))
                    echo Template::instance()->render($template);
            } else {
                echo Template::instance()->render('layout.htm');
            }
        } else {
            echo Template::instance()->render('index.htm');
        }
    }
}
