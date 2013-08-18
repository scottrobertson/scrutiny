<?php

namespace Scottymeuk\Monitor\Service;

class Base
{
    private $name = null;
    private $messages = array();

    private $interval = 5;
    private $last_run = false;

    private $status = true;
    private $count = 0;

    private $send_report = false;

    public function checkable()
    {
        return $this->last_run === false || (time() - $this->last_run >= $this->interval);
    }

    public function setStatus($status = false)
    {
        $this->last_run = time();

        // If the status has changed, then send a report
        if ($this->status !== $status) {
            $this->send_report = true;
        } else {
            $this->send_report = false;
        }

        if ($status === true) {
            $this->count = 0;
        }

        // If there has been no change in the status since last time, then keep a counter
        if ($status === $this->status) {
            $this->count++;
        }

        $this->status = $status;
        return $this->status;
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
