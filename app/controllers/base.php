<?php
namespace controllers;
/**
 * Base Controller Class
 *
 */

abstract class Base extends \Prefab
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
}
