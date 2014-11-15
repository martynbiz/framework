<?php

/*
Still to test...
- condtions etc is it a number? p:id toka
*/

use MartynBiz\Dispatcher;

class DispatcherTest extends PHPUnit_Framework_TestCase
{
    protected $mockApp;
    
    public function setUp()
    {
        $this->mockApp = $this->getMockBuilder('MartynBiz\Application')
            ->disableOriginalConstructor()
            ->getMock();
    }
    
    public function testClassInstantiates()
    {
        $mockApp = $this->mockApp;
        
        $dispatcher = new Dispatcher($mockApp);
        
        $this->assertTrue($dispatcher instanceof Dispatcher);
    }
    
    /**
     * @depends testClassInstantiates
     * @expectedException Exception
     */
    public function testLoadRouteThrowsExceptionWhenControllerMissing()
    {
        // mock route
        $route = array(
            'controller' => 'home',
            'action' => 'show',
            'params' => array(1),
        );
        
        // mock the app
        $appMock = $this->mockApp;
        $appMock->expects( $this->once() )
            ->method('service')
            ->with( 'controllers.' . $route['controller'] )
            ->will( $this->returnValue( null ) );
        
        $dispatcher = new Dispatcher($appMock);
        
        $dispatcher->loadRoute($route);
    }
    
    /**
     * @depends testClassInstantiates
     */
    public function testLoadRouteCallsUponCorrectController()
    {
        // mock route
        $route = array(
            'controller' => 'home',
            'action' => 'show',
            'params' => array(1),
        );
        
        // mock the controller
        $homeControllerMock = $this->getMockBuilder('HomeController')
            ->disableOriginalConstructor()
            ->getMock();
        $homeControllerMock->expects( $this->once() )
            ->method($route['action'] . 'Action')
            ->with( $route['params'][0] );
        
        // mock the app
        $appMock = $this->mockApp;
        $appMock->expects( $this->once() )
            ->method('service')
            ->with( 'controllers.' . $route['controller'] )
            ->will( $this->returnValue( $homeControllerMock ) );
        
        $dispatcher = new Dispatcher($appMock);
        
        $dispatcher->loadRoute($route);
    }
}