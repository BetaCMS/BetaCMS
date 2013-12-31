<?php

/**
 * Base Model Class
 */

abstract class Model extends \Prefab
{

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
     * database table prefix
     *
     * @var prefix
     */
    protected $prefix;

    /**
     * app logger instance
     *
     * @var logger
     */
    protected $logger;

    /**
     * initialize model
     *
     */
    public function __construct()
    {
        $this->app = \Base::instance();
        $this->db = \Registry::get('db');
        $this->logger = \Registry::get('logger');
        $this->prefix = $this->app->exists('db.prefix') ? $this->app->get('db.prefix') . '_' : '';
    }

    /**
     * data Mapper
     *
     */
    public function mapper($table)
    {
        return new DB\SQL\Mapper($this->db, strpos($table, $this->prefix) == 0 ? $table : $this->prefix . $table);
    }

    /**
     * data Schema
     *
     */
    protected function schema()
    {
        return new \DB\SQL\Schema($this->db);
    }
}
