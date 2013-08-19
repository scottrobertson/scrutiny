<?php

namespace ScottRobertson\Scrutiny\Test\Service;

class BaseTest extends \ScottRobertson\Scrutiny\Test\TestCase
{
    public function testInit()
    {
        $base = new \ScottRobertson\Scrutiny\Service\Base();
        $this->assertTrue(is_object($base));
        $this->assertTrue(method_exists($base, 'checkable'));
        $this->assertTrue(method_exists($base, 'getStatus'));
    }

    public function testSetStatusDown()
    {
        $base = new \ScottRobertson\Scrutiny\Service\Base();

        $status = $base->setStatus();
        $this->assertTrue(property_exists($status, 'name'));
        $this->assertTrue(property_exists($status, 'event'));
        $this->assertTrue(property_exists($status, 'count'));
        $this->assertEquals('down', $status->getEvent());
    }

    public function testSetStatusUp()
    {
        $base = new \ScottRobertson\Scrutiny\Service\Base();

        $status = $base->setStatus(true);
        $this->assertTrue(property_exists($status, 'name'));
        $this->assertTrue(property_exists($status, 'event'));
        $this->assertTrue(property_exists($status, 'count'));
        $this->assertEquals('up', $status->getEvent());
    }

    public function testSetStatusStillDown()
    {
        $base = new \ScottRobertson\Scrutiny\Service\Base();

        // Send the 'down' event twice
        $base->setStatus(false);
        $status = $base->setStatus(false);

        $this->assertTrue(property_exists($status, 'name'));
        $this->assertTrue(property_exists($status, 'event'));
        $this->assertTrue(property_exists($status, 'count'));
        $this->assertEquals('down', $status->getEvent());
        $this->assertEquals(1, $status->getCount());
    }

    public function testSetStatusRecovery()
    {
        $base = new \ScottRobertson\Scrutiny\Service\Base();

        // Send the 'down' event twice
        $base->setStatus(false);
        $status = $base->setStatus(true);

        $this->assertTrue(property_exists($status, 'name'));
        $this->assertTrue(property_exists($status, 'event'));
        $this->assertTrue(property_exists($status, 'count'));
        $this->assertEquals('recovery', $status->getEvent());
    }

    public function testCheckable()
    {
        $base = new \ScottRobertson\Scrutiny\Service\Base();
        $this->assertTrue($base->checkable());
    }

    public function testGetEvent()
    {
        $base = new \ScottRobertson\Scrutiny\Service\Base();
        $this->assertEquals('up', $base->getEvent());
    }

    public function testGetCount()
    {
        $base = new \ScottRobertson\Scrutiny\Service\Base();
        $this->assertEquals(0, $base->getCount());
    }

    public function testGetInterval()
    {
        $base = new \ScottRobertson\Scrutiny\Service\Base();
        $this->assertEquals(5, $base->getInterval());
    }

    public function testGetStatus()
    {
        $base = new \ScottRobertson\Scrutiny\Service\Base();
        $this->assertTrue($base->getStatus());
    }

    public function testGetTime()
    {
        $base = new \ScottRobertson\Scrutiny\Service\Base();
        $this->assertFalse($base->getTime());
    }

    public function testGetMessageFromEventUp()
    {
        $base = new \ScottRobertson\Scrutiny\Service\Base();
        $this->assertEquals('up', $base->getEvent());

        $base->setUpMessage('testing');
        $this->assertEquals('testing', $base->getMessageFromEvent());
    }

    public function testGetMessageFromEventDown()
    {
        $base = new \ScottRobertson\Scrutiny\Service\Base();
        $base->setStatus(false);

        $this->assertEquals('down', $base->getEvent());

        $base->setDownMessage('testing');
        $this->assertEquals('testing', $base->getMessageFromEvent());
    }

    public function testGetMessageFromEventRecovery()
    {
        $base = new \ScottRobertson\Scrutiny\Service\Base();
        $base->setStatus(false);
        $base->setStatus(true);

        $base->setRecoveryMessage('testing');

        $this->assertEquals('recovery', $base->getEvent());
        $this->assertEquals('testing', $base->getMessageFromEvent());
    }

    public function testGetRecoveryMessage()
    {
        $base = new \ScottRobertson\Scrutiny\Service\Base();

        $this->assertTrue(is_string($base->getRecoveryMessage()));
    }

    public function testSetRecoveryMessage()
    {
        $base = new \ScottRobertson\Scrutiny\Service\Base();

        $base->setRecoveryMessage('testing');
        $this->assertEquals('testing', $base->getRecoveryMessage());
    }

    public function testGetDownMessage()
    {
        $base = new \ScottRobertson\Scrutiny\Service\Base();

        $this->assertTrue(is_string($base->getDownMessage()));
    }

    public function testSetDownMessage()
    {
        $base = new \ScottRobertson\Scrutiny\Service\Base();

        $base->setDownMessage('testing');
        $this->assertEquals('testing', $base->getDownMessage());
    }

    public function testSetUpMessage()
    {
        $base = new \ScottRobertson\Scrutiny\Service\Base();

        $base->setUpMessage('testing');
        $this->assertEquals('testing', $base->getUpMessage());
    }

    public function testGetData()
    {
        $base = new \ScottRobertson\Scrutiny\Service\Base();
        $base->setData('testing', 'testing');
        $this->assertEquals('testing', $base->getData('testing'));
    }

    public function testGetDataNull()
    {
        $base = new \ScottRobertson\Scrutiny\Service\Base();
        $this->assertEquals(null, $base->getData('testing'));
    }

    public function testGetDataAll()
    {
        $base = new \ScottRobertson\Scrutiny\Service\Base();
        $this->assertTrue(is_array($base->getData()));
    }
}
