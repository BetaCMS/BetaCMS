<?php
namespace models;
/**
 * Base Model Class
 *
 */

abstract class Base extends \Prefab
{

    /**
     * instance
     *
     * @var $app
     */
    protected $app;

    /**
     * database connection
     *
     * @var db
     */
    protected $db;

    /**
     * logger instance
     *
     * @var logger
     */
    protected $logger;

    /**
     * initialize model
     */
    public function __construct()
    {
        $this->app = \Base::instance();
        $this->db = \Registry::get('db');
        $this->logger = \Registry::get('logger');
    }
}
