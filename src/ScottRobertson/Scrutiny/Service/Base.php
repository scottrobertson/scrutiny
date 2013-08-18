<?php

namespace ScottRobertson\Scrutiny\Service;

class Base
{
    private $name = null;
    private $messages = array();

    private $interval = 5;
    private $last_run = false;

    private $status = true;
    private $event = 'up';
    private $count = 0;


    private $send_report = false;

    public function checkable()
    {
        return $this->last_run === false || (time() - $this->last_run >= $this->interval);
    }

    public function setStatus($status = false)
    {
        $this->last_run = time();

        // If the same
        if ($status === $this->status) {

            // Keep track of how long the status has not changed
            $this->count++;
            $this->status = $status;

            // Still down
            if ($this->status === false) {
                $this->event = 'down';
            } else {
                $this->event = 'up';
            }
        } else {

            // Reset the count, something has changed
            $this->count = 0;

            // Down
            if ($this->status === true && $status === false) {
                $this->event = 'down';
            }

            // Recovery
            if ($this->status === false && $status === true) {
                $this->event = 'recovery';
            }

            $this->status = $status;
        }

        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDownMessage($message)
    {
        $this->messages['down'] = $message;
    }

    public function setUpMessage($message)
    {
        $this->messages['up'] = $message;
    }

    public function setInterval($interval)
    {
        $this->interval = $interval;
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function getDownMessage()
    {
        if (isset($this->messages['down'])) {
            return $this->messages['down'];
        }

        return $this->name . ' is down.';
    }

    public function getUpMessage()
    {
        if (isset($this->messages['up'])) {
            return $this->messages['up'];
        }

        return $this->name . ' is back up.';
    }

    public function sendReport()
    {
        return $this->send_report;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function getInterval()
    {
        return $this->interval;
    }

    public function getStatus()
    {
        return $this->status;
    }
}
