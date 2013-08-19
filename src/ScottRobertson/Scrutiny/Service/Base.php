<?php

namespace ScottRobertson\Scrutiny\Service;

class Base
{
    /**
     * The name of the service
     * @var string
     */
    protected $name = null;

    /**
     * Array of messages to return. "up" message for example
     * @var array
     */
    protected $messages = array();

    /**
     * How often should we check this service
     * @var integer
     */
    protected $interval = 5;

    /**
     * When did we last check this service?
     * @var int
     */
    protected $time = false;

    /**
     * The current status of the service
     * @var boolean
     */
    protected $status = true;

    /**
     * The last event that has been fired
     * @var string
     */
    protected $event = 'up';

    /**
     * How many times has the current event been fired
     * @var integer
     */
    protected $count = 0;

    /**
     * Store the meta data
     * @var array
     */
    protected $data = array();

    /**
     * Has the specified interval elapsed since the last run?
     * @return bool
     */
    public function checkable()
    {
        return $this->time === false || (time() - $this->time >= $this->interval);
    }

    /**
     * Get the status message from the current event
     * @return string
     */
    public function getMessageFromEvent()
    {
        if ($this->event === 'up') {
            $message = $this->getUpMessage();
        } elseif ($this->event === 'down') {
            $message = $this->getDownMessage();
        } elseif ($this->event === 'recovery') {
            $message = $this->getRecoveryMessage();
        }

        return $message;
    }

    /**
     * Status of the service
     * @param boolean $status
     */
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
            if ($status === false) {
                $this->event = 'down';
            }

            // Recovery
            if ($this->status === false && $status === true) {
                $this->event = 'recovery';
            }

            $this->status = $status;
        }
    }

    /**
     * Set the name of the current service
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Set the message to return when the service is down
     * @param string $message
     */
    public function setDownMessage($message)
    {
        $this->messages['down'] = $message;
    }

    /**
     * Set the message to return when the service is up
     * @param string $message
     */
    public function setUpMessage($message)
    {
        $this->messages['up'] = $message;
    }

    /**
     * Set the message to return when the service recovering
     * @param string $message
     */
    public function setRecoveryMessage($message)
    {
        $this->messages['recovery'] = $message;
    }

    /**
     * How often should we run this service check?
     * @param int $interval
     */
    public function setInterval($interval)
    {
        $this->interval = $interval;
    }

    /**
     * Set any meta data we wish to pass to reporter
     * @param string $key
     * @param string|array $data
     */
    public function setData($key, $data)
    {
        $this->data[$key] = $data;
    }

    /**
     * Return the meta data
     * @param  string $key
     * @return array|string
     */
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

    /**
     * Return the event name
     * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Get the message to return when the service is down
     * @return string
     */
    public function getDownMessage()
    {
        if (isset($this->messages['down'])) {
            return $this->messages['down'];
        }

        return $this->name . ' is down.';
    }

    /**
     * Get the message to return when the service is up
     * @return string
     */
    public function getUpMessage()
    {
        if (isset($this->messages['up'])) {
            return $this->messages['up'];
        }

        return $this->name . ' is up.';
    }

    /**
     * Get the message to return when the service is recovering
     * @return string
     */
    public function getRecoveryMessage()
    {
        if (isset($this->messages['recovery'])) {
            return $this->messages['recovery'];
        }

        return $this->name . ' is back up.';
    }

    /**
     * Return the current event count
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Return the checking interval
     * @return int
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * Return the current status of the service
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Return the time of the last check
     * @return int
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Return the name of the service
     * @return int
     */
    public function getName()
    {
        return $this->name;
    }
}
