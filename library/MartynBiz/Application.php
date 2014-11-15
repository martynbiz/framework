<?php

namespace MartynBiz;

/**
* Having an App class acts as a registry and service locator
*/
class Application
{
    /**
    * this is the applciation's config settings
    */
    protected $config = array();
    
    /**
    * this is the applciation's services
    */
    protected $services = array();
    
    /**
    * Class constructor. Set config, services
    */
    public function __construct($config=array())
    {
        // set services from config
        $this->service('Router', new Router());
        $this->service('Dispatcher', new Dispatcher());
        
        // init routes - then discard routes from config
        if (isset($config['routes'])) {
            $this->service('Router')->init($config['routes']);
            unset($config['routes']);
        }
        
        // set services - then discard services from config
        if(isset($config['services'])) {
            $this->service($config['services']);
            unset($config['services']);
        }
        
        // set config
        $this->config($config);
        
        // configure the router
        $router = $this->service('Router');
        if($router and isset($config['routes']))
            $router->init($config['routes']);
    }
    
    /**
    * Get or set config. Can support simple data type setting, and multiple setting with array
    *
    * @param mixed $config Either the value of a single config, an array containing many configs, or blank
    * @param mixed $value Value of the config to set, or blank
    * 
    * @return mixed Config value(s)
    */
    public function config($config, $value=null)
    {
        if (is_array($config)) { // multiple set
            
            // merge config with array
            $this->config = array_merge($this->config, $config);
            
        } elseif(! is_null($value)) { // value not passed, return config
            
            // set config
            $this->config[$config] = $value;
            
        } else { // value not passed, return config
            
            // return config
            if(isset($this->config[$config]))
                return $this->config[$config];
            
        }
    }
    
    /**
    * Get or set service. Can support objects, functions (factory), strings (auto instantiate)
    *
    * @param mixed $config Either the value of a single config, an array containing many configs, or blank
    * @param mixed $value Value of the config to set, or blank
    * 
    * @return mixed Config value(s)
    */
    public function service($service, $value=null)
    {
        if (is_array($service)) { // multiple set
            
            // merge services with array
            $this->services = array_merge($this->services, $service);
            
        } elseif(! is_null($value)) { // value not passed, return services
            
            // set services
            $this->services[$service] = $value;
            
        } else { // value not passed, return services
            
            // return services
            if(isset($this->services[$service]))
                return $this->services[$service];
            
        }
    }
    
    /**
    * Run the application. Fetch the route for the url from the router, dispatch the controller, render the view
    * 
    * @param $environment array Environment can be overridden when testing
    */
    public function run($environment=array())
    {
        // get services
        $router = $this->service('Router');
        $dispatcher = $this->service('Dispatcher');
        
        // set the environment from $_SERVER, $_POST, $environment, ...
        $environment = array_merge($_SERVER, array(
            'post' => $_POST,
        ), $environment);
        
        // get the route for this url
        $url = (isset($environment['PATH_INFO'])) ? $environment['PATH_INFO'] : $environment['REQUEST_URI'];
        $method = $environment['REQUEST_METHOD'];
        $route = $router->getRoute($url, $method);
        
        // dispatch the route
        $dispatcher->loadRoute($route);
    }
    
}