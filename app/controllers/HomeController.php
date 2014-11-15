<?php

namespace App\Controller;

/**
* Handkes homepage, about etc
*/
class HomeController extends \MartynBiz\Controller
{
    function showAction($id)
    {
        return array(
            'accounts' => array(),
        );
    }
}