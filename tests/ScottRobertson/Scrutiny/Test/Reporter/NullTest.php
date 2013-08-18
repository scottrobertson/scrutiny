<?php

namespace ScottRobertson\Scrutiny\Test\Reporter;

class NullTest extends \ScottRobertson\Scrutiny\Test\TestCase
{
    public function testInit()
    {
        $base = new \ScottRobertson\Scrutiny\Reporter\Null();
        $this->assertTrue(is_object($base));
        $this->assertTrue(method_exists($base, 'report'));
        $this->assertTrue(method_exists($base, 'subscribed'));
        $this->assertTrue(method_exists($base, 'subscribe'));
    }

    public function testReport()
    {
        $base = new \ScottRobertson\Scrutiny\Reporter\Null();
        $this->assertTrue(is_object($base));
        $this->assertTrue(method_exists($base, 'report'));
        $this->assertTrue($base->report('test', 'test'));

    }
}
