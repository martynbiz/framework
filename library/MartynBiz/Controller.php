<?php

namespace MartynBiz;

/**
* Controller
*/
class Controller
{
    protected $app;
    
    /**
    * Init function can be called after instantiation which works well for services
    */
    function init(\MartynBiz\Application $app)
    {
        $this->app = $app;
    }
}