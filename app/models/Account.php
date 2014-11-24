<?php

namespace App\Model;

/**
* 
*/
class Account extends \MartynBiz\MVC\Database\Table
{
    protected $tableName = 'accounts';
    
    protected $belongsTo = array(
        'user' => array(
            'table' => 'App\\Model\\User',
            'foreign_key' => 'user_id',
        )
    );
}