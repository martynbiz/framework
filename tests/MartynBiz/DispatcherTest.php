<?php

/*
Still to test...
- condtions etc is it a number? p:id toka
*/

use MartynBiz\Dispatcher;

class DispatcherTest extends PHPUnit_Framework_TestCase
{
    public function testClassInstantiates()
    {
        $dispatcher = new Dispatcher();
        
        $this->assertTrue($dispatcher instanceof Dispatcher);
    }
}