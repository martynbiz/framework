<?php

namespace App\Model;

/**
* 
*/
class User extends \MartynBiz\Database\Table
{
    protected $tableName = 'users';
    
    protected $hasMany = array(
        'accounts' => array(
            'table' => 'App\\Model\\Account',
            'foreign_key' => 'user_id',
        )
    );
}