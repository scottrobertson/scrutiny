<?php

namespace ScottRobertson\Scrutiny\Test\Reporter;

class PushoverTest extends \ScottRobertson\Scrutiny\Test\TestCase
{
    public function testInit()
    {
        $base = new \ScottRobertson\Scrutiny\Reporter\Pushover('token', 'user');
        $this->assertTrue(is_object($base));
        $this->assertTrue(method_exists($base, 'report'));
        $this->assertTrue(method_exists($base, 'subscribed'));
        $this->assertTrue(method_exists($base, 'subscribe'));
    }

    public function testReport()
    {
        $base = new \ScottRobertson\Scrutiny\Reporter\Pushover('token', 'user');
        $this->assertTrue(is_object($base));
        $this->assertTrue(method_exists($base, 'report'));

        // Mock the service, and pushover client
        $base->pushover = new \ScottRobertson\Scrutiny\Mock\Reporter\Pushover();
        $service = new \ScottRobertson\Scrutiny\Mock\Service();

        $this->assertTrue($base->report($service));
    }
}
