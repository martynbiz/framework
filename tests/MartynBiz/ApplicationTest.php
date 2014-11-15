<?php

use MartynBiz\Application;

/**
* AppTest
*/
class ApplicationTest extends PHPUnit_Framework_TestCase
{
    
    function setUp()
    {
        
    }
    
    public function testClassInstantiates()
    {
        $app = new MartynBiz\Application();
        
        $this->assertTrue($app instanceof Application);
    }
    
    function testConfigMethodGetsVariable()
    {
        $config = array(
            'test' => true,
        );
        
        $app = new MartynBiz\Application($config);
        
        $this->assertEquals(true, $app->config('test'));
    }
    
    function testConfigMethodSetsVariable()
    {
        $app = new MartynBiz\Application();
        
        $app->config('test', true);
        
        $this->assertEquals(true, $app->config('test'));
    }
    
    function testConfigMethodSetsArray()
    {
        $app = new MartynBiz\Application();
        
        $app->config(array(
            'test' => true,
        ));
        
        $this->assertEquals(true, $app->config('test'));
    }
    
    function testServiceMethodGetsVariable()
    {
        $testService = new \stdClass();
        
        $config = array(
            'services' => array(
                'TestService' => $testService,
            ),
        );
        
        $app = new MartynBiz\Application($config);
        
        $this->assertEquals($testService, $app->service('TestService'));
    }
    
    function testServiceMethodSetsVariable()
    {
        $app = new MartynBiz\Application();
        
        $testService = new \stdClass();
        
        $app->service('TestService', $testService);
        
        $this->assertEquals($testService, $app->service('TestService'));
    }
    
    function testServiceMethodSetsArray()
    {
        $app = new MartynBiz\Application();
        
        $testService = new \stdClass();
        
        $app->service(array(
            'TestService' => $testService,
        ));
        
        $this->assertEquals($testService, $app->service('TestService'));
    }
    
}