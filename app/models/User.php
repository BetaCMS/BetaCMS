<?php
/**
 * User Model Class
 */

class User extends Model
{

    public function index()
    {
        $schema = new \DB\SQL\Schema($this->db);


        $table = $schema->createTable($this->app->get('db.prefix') . '_users');
        $table->addColumn('ID')->type($schema::DT_INT1)->nullable(false);
        $table->addColumn('user_login')->type($schema->type_varchar(60))->defaults('')->nullable(false);
        $table->addColumn('user_pass')->type($schema->type_varchar(64))->defaults('')->nullable(false);
        $table->addColumn('user_nicename')->type($schema->type_varchar(50))->defaults('')->nullable(false);
        $table->addColumn('user_email')->type($schema->type_varchar(100))->defaults('')->nullable(false);
        $table->addColumn('user_url')->type($schema->type_varchar(100))->defaults('')->nullable(false);
        $table->addColumn('user_registered')->type($schema::DT_DATETIME)->defaults('0000-00-00 00:00:00')->nullable(false);;
        $table->addColumn('user_activation_key')->type($schema->type_varchar(60))->defaults('');
        $table->addColumn('user_status')->type($schema::DT_INT)->defaults('0')->nullable(false);;
        $table->addColumn('display_name')->type($schema->type_varchar(250))->defaults('')->nullable(false);;
        $table->build();


        echo 'models';
    }
}
