<?php

namespace Scottymeuk\Scrutiny\Reporter;

class Base
{
    private $subscriptions = array('down', 'recovery');

    public function getMessage($service, $hostname)
    {
        $message = '[' . $hostname . '] ';
        if ($service->getStatus()) {
            $message .= $service->getUpMessage();
        } else {
            $message .= $service->getDownMessage();
        }

        return $message;
    }

    public function report($service, $hostname)
    {
        $message = $this->getMessage($service, $hostname);
        $this->sender($message);
    }

    public function subscribed($event)
    {
        return in_array($event, $this->subscriptions);
    }

    public function subscribe($events)
    {
        $this->subscriptions = $events;
    }
}
