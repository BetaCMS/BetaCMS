<?php

/**
 * Base Model Class
 */

abstract class Model extends \Prefab {

    /**
     * app instance
     *
     * @var app
     */
    protected $app;

    /**
     * database connection
     *
     * @var db
     */
    protected $db;

    /**
     * f3 logger instance
     *
     * @var logger
     */
    protected $logger;

    /**
     * initialize model
     *
     */
    public function __construct() {
        $this->app = \Base::instance();
        $this->db = \Registry::get('db');
        $this->logger = \Registry::get('logger');
    }
}
