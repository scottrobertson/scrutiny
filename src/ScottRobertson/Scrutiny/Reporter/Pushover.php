<?php

namespace ScottRobertson\Scrutiny\Reporter;

class Pushover extends Base
{
    private $token;
    private $user;
    private $pushover;

    public function __construct($token, $user)
    {
        $this->subscribe(
            array(
                'down',
                'recovery'
            )
        );

        $this->token = $token;
        $this->user = $user;
        $this->pushover = new \scottymeuk\Pushover\Client(
            array(
                'token' => $this->token
            )
        );
    }

    public function report($service, $hostname)
    {
        $message = $this->getMessage($service, $hostname);

        $this->pushover->message = $message;
        $this->pushover->push($this->user);
    }
}
