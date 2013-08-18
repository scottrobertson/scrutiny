<?php

namespace ScottRobertson\Scrutiny\Service;

class Base
{
    protected $name = null;
    protected $messages = array();

    protected $interval = 5;
    protected $time = false;

    protected $status = true;
    protected $status_message = null;

    protected $event = 'up';
    protected $count = 0;

    protected $data = array();

    protected $send_report = false;

    public function checkable()
    {
        return $this->time === false || (time() - $this->time >= $this->interval);
    }

    public function getMessageFromEvent()
    {
        if ($this->event === 'up') {
            $message = $this->getUpMessage();
        } elseif ($this->event === 'down') {
            $message = $this->getDownMessage();
        } elseif ($this->event === 'recovery') {
            $message = $this->getRecoveryMessage();
        }

        $this->status_message = $message;
        return $this->status_message;
    }

    public function setStatus($status = false)
    {
        $this->time = time();

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

    public function setRecoveryMessage($message)
    {
        $this->messages['recovery'] = $message;
    }

    public function setInterval($interval)
    {
        $this->interval = $interval;
    }

    public function setData($key, $data)
    {
        $this->data[$key] = $data;
    }

    public function getData($key = false)
    {
        if ($key === false) {
            return $this->data;
        }

        if (isset($this->data[$key])) {
            return $this->data[$key];
        }

        return false;
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function getStatusMessage()
    {
        return $this->getMessageFromEvent();
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

        return $this->name . ' is up.';
    }

    public function getRecoveryMessage()
    {
        if (isset($this->messages['recovery'])) {
            return $this->messages['recovery'];
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

    public function getTime()
    {
        return $this->time;
    }
}
