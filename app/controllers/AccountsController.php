<?php

namespace App\Controller;

/**
* Handkes homepage, about etc
*/
class AccountsController extends \MartynBiz\Controller
{
    function showAction($id)
    {
        return array(
            'accounts' => array(),
        );
    }
}