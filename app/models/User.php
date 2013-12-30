<?php
/**
 * User Model Class
 */

class User extends Model
{

    public function index()
    {
        $user=new DB\SQL\Mapper($this->db,'users',array(
            'order',
            'group',
            'limit',
            'offset'
        ));

        $user->save();

        //$user->insert('admin','admin888');


        echo $this->db->version();
        echo '\n';
        echo $this->db->name();
        echo '\n';
        $columns=$this->db->schema('mytable');
        var_dump($columns);

        echo 'models';
    }
}
