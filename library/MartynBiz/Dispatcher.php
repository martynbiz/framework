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
    * Instance of Application
    */ 
    protected $app;
    
    /** 
    * Construct the object and initiate the route defining
    * 
    * @param $app Application Our app instance
    */
    public function __construct(\MartynBiz\Application $app)
    {
        $this->app = $app;
    }
    
    /** 
    * load a route
    * 
    * @param $route array Array containing items relevant to this route (e.g. controller, params)
    */
    public function loadRoute($route)
    {
        $controller = $this->app->service('controllers.' . $route['controller']);
        if(is_null($controller))
            throw new \Exception($route['controller'] . ' controller not set in services.');
        
        // initiate controller
        $controller->init($this->app); // load the app
        
        $result = call_user_func_array(array($controller, $route['action'] . 'Action'), $route['params']);
        
        // determine which kind of request it is: xhr, render json; traditional, render template
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            // ajax request - json?
            echo json_encode($result);
        } else {
            // render with layout and view
            
        }
    }
}