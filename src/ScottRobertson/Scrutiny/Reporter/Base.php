<?php

namespace ScottRobertson\Scrutiny\Reporter;

class Base
{
    /**
     * Holds an array of what events the reporter is subscribed to
     * @var array
     */
    protected $subscriptions = array(
        'down',
        'recovery'
    );

    /**
     * Check to see if the reporter is subscribed to an event
     * @param  string $event
     * @return bool
     */
    public function subscribed($event)
    {
        return in_array($event, $this->subscriptions);
    }

    /**
     * Subscribe the reporter to an event
     * @param  array $events
     */
    public function subscribe(array $events)
    {
        $this->subscriptions = $events;
    }
}
