<?php

namespace ScottRobertson\Scrutiny\Reporter;

class Base
{
    private $subscriptions = array('down', 'recovery');

    public function subscribed($event)
    {
        return in_array($event, $this->subscriptions);
    }

    public function subscribe($events)
    {
        $this->subscriptions = $events;
    }
}
