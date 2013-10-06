<?php

namespace ScottRobertson\Scrutiny\Test\Service;

class HttpTest extends \ScottRobertson\Scrutiny\Test\TestCase
{
    public function testInit()
    {
        $http = new \ScottRobertson\Scrutiny\Service\Http('http://127.0.0.1');
        $this->assertTrue(is_object($http));
        $this->assertTrue(method_exists($http, 'checkable'));
        $this->assertTrue(method_exists($http, 'getStatus'));
        $this->assertTrue(method_exists($http, 'isOnline'));
    }
}
