<?php

namespace ScottRobertson\Scrutiny\Test;

class ClientTest extends TestCase
{
    public function testInit()
    {
        $client = new \ScottRobertson\Scrutiny\Client();
        $this->assertTrue(is_object($client));
        $this->assertCount(0, $client->getServices());
        $this->assertCount(0, $client->getReporters());
    }

    public function testAddService()
    {
        $client = new \ScottRobertson\Scrutiny\Client();
        $client->addService(new \ScottRobertson\Scrutiny\Service\Http('http://google.com'));
        $this->assertCount(1, $client->getServices());
    }

    public function testAddReporter()
    {
        $client = new \ScottRobertson\Scrutiny\Client();
        $client->addReporter(new \ScottRobertson\Scrutiny\Reporter\Null());
        $this->assertCount(1, $client->getReporters());
    }
}
