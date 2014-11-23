<?php

namespace App\Model;

/**
* 
*/
class Account extends \MartynBiz\Database\Table
{
    protected $tableName = 'accounts';
    
    protected $belongsTo = array(
        'user' => array(
            'table' => 'App\\Model\\User',
            'foreign_key' => 'user_id',
        )
    );
}