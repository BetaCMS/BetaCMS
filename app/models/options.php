<?php
/**
 * User Model Class
 */

class Options extends Model
{
    protected $table = "options";

    function __construct()
    {
        parent::__construct();
        $this->table = $this->prefix . $this->table;
        $this->createTable();
    }

    protected function createTable()
    {
        $schema = $this->schema();

        if ($schema->existsTables($this->table)) {
            return;
        }
        $schema->dropTable($this->table);
        $table = $schema->createTable($this->table);

        $table->addColumn('option_name')->type_varchar(64)->defaults('')->nullable(false);
        $table->addColumn('option_value')->type_longtext()->nullable(false);
        $table->addColumn('autoload')->type_varchar(20)->defaults('yes')->nullable(false);

        $table->addIndex('option_name', true);
        $table->primary('option_id');

        $table->build();
    }


    public function index()
    {


    }
}
