<?php

namespace ScottRobertson\Scrutiny\Reporter;

class Pushover extends Base
{
    protected $token;
    protected $user;
    public $pushover;

    public function __construct($token, $user, array $subscribe = array('down', 'recovery'))
    {
        // Subscribe to events
        $this->subscribe($subscribe);

        $this->token = $token;
        $this->user = $user;
        $this->pushover = new \Scottymeuk\Pushover\Client(
            array(
                'token' => $this->token
            )
        );
    }

    public function report($service)
    {
        $this->pushover->title = $service->getMessageFromEvent();
        $this->pushover->message = $service->getName() . ' returned ' . $service->getData('code');
        $this->pushover->timestamp = $service->getTime();
        $this->pushover->url = $service->getData('url');
        return $this->pushover->push($this->user);
    }
}
