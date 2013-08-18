<?php

namespace ScottRobertson\Scrutiny\Test\Reporter;

class BaseTest extends \ScottRobertson\Scrutiny\Test\TestCase
{
    public function testInit()
    {
        $base = new \ScottRobertson\Scrutiny\Reporter\Base();
        $this->assertTrue(is_object($base));
        $this->assertTrue(method_exists($base, 'subscribed'));
        $this->assertTrue(method_exists($base, 'subscribe'));
    }

    public function testSubscribe()
    {
        $base = new \ScottRobertson\Scrutiny\Reporter\Base();
        $this->assertTrue(is_object($base));

        $base->subscribe(array('up'));

        $this->assertTrue($base->subscribed('up'));
        $this->assertFalse($base->subscribed('down'));
    }
}
