<?php
/**
* Router class
* This is a seperate class which allows for unit testing specific to this class only
* 
*/

namespace MartynBiz;

/**
* Dispatcher
*/
class Dispatcher implements DispatcherInterface
{
    /** 
    * load a route
    * 
    * @param $route array Array containing items relevant to this route (e.g. controller, params)
    */
    public function loadRoute($route)
    {
        var_dump($route);
    }
}