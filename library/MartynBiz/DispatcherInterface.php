<?php
/**
* Router class
* This is a seperate class which allows for unit testing specific to this class only
* 
*/

namespace MartynBiz;

/**
* DispatcherInterface
*/
interface DispatcherInterface
{
    public function __construct(\MartynBiz\Application $app);
    public function loadRoute($route);
}