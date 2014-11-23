<?php

namespace App\Controller;

/**
* Handkes homepage, about etc
*/
class BaseController extends \MartynBiz\Controller
{
    public function getCurrentUser()
    {
        $usersTable = $this->app->service('models.usersTable');
        
        $user = $usersTable->find(1);
        
        return $user;
    }
}