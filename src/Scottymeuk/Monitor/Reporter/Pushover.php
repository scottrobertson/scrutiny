<?php

namespace Scottymeuk\Monitor\Reporter;

class Pushover extends Base
{
    private $token;
    private $user;
    private $pushover;

    public function __construct($token, $user)
    {
        $this->token = $token;
        $this->user = $user;
        $this->pushover = new \Scottymeuk\Pushover\Client(
            array(
                'token' => $this->token
            )
        );
    }

    public function sender($message)
    {
        $this->pushover->message = $message;
        $this->pushover->push($this->user);
    }
}
