<?php
/**
 * User Model Class
 */

class User extends Model
{
    protected $table = "users";

    function __construct()
    {
        parent::__construct();
        $this->table = $this->prefix . "users";
    }

    protected function createTable()
    {
        $schema = $this->schema();

        if ($schema->alterTable($this->table)) {
            return;
        }
        $schema->dropTable($this->table);
        $table = $schema->createTable($this->table);

        $table->addColumn('user_login')->type_varchar(60)->defaults('')->nullable(false);
        $table->addColumn('user_pass')->type_varchar(64)->defaults('')->nullable(false);
        $table->addColumn('user_nicename')->type_varchar(50)->defaults('')->nullable(false);
        $table->addColumn('user_email')->type_varchar(100)->defaults('')->nullable(false);
        $table->addColumn('user_url')->type_varchar(100)->defaults('')->nullable(false);
        $table->addColumn('user_registered')->type($schema::DT_DATETIME)->defaults('0000-00-00 00:00:00')->nullable(false);
        $table->addColumn('user_activation_key')->type_varchar(60)->defaults('')->nullable(false);
        $table->addColumn('user_status')->type_int(11)->defaults('0')->nullable(false);
        $table->addColumn('display_name')->type_varchar(250)->defaults('')->nullable(false);

        $table->addIndex('user_login');
        $table->addIndex('user_nicename');

        $table->build();
    }


    public function index()
    {
        $user = self::mapper($this->table);

        $user->load();
        if (!$user->user_login) {

        } else {
            /*$user->user_login = 'hizhengfu';
            $user->user_pass = 'hizhengfu';
            $user->user_nicename = 'hizhengfu';
            $user->user_email = 'hizhengfu@gmail.com';
            $user->user_url = 'com';
            $user->user_registered = date('Y-m-d H:i:s');
            $user->user_activation_key = 'acnkjfksjdf';
            $user->user_status = 10;
            $user->display_name = 'hizhengfu';*/
            $data=array(
                'user_login' => 'hizhengfu',
                'user_pass' => 'hizhengfu',
                'user_nicename' => 'hizhengfu',
                'user_email' => 'hizhengfu',
                'user_url' => 'hizhengfu',
                'user_registered' => date('Y-m-d H:i:s'),
                'user_activation_key' => 'acnkjfksjdf',
                'user_status' => 10,
                'display_name' => 'hizhengfu'
            );
            //$user->copyto($data);
            //$user->insert($data);

            $user->save();
        }

        foreach ($user->find() as $u) {
            echo var_dump($u->cast());
        }
        echo $user->count();


        echo 'models';
    }
}
