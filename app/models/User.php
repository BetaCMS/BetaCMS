<?php
/**
 * Index Controller Class
 */

class User extends Model
{

    public function index()
    {
        echo $this->db->version();
        echo '\n';
        echo $this->db->name();
        echo '\n';
        $columns=$this->db->schema('mytable');
        var_dump($columns);

        echo 'models';
    }
}
