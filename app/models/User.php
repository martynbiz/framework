<?php

namespace App\Model;

/**
* 
*/
class User extends \MartynBiz\MVC\Database\Table
{
    protected $tableName = 'users';
    
    protected $hasMany = array(
        'accounts' => array(
            'table' => 'App\\Model\\Account',
            'foreign_key' => 'user_id',
        )
    );
}