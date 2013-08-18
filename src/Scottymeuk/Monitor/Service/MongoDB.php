<?php

namespace Scottymeuk\Monitor\Service;

class MongoDB extends Base
{
    public function __construct()
    {
        $this->setName('MongoDB');
        $this->setInterval(5);
    }

    public function getStatus()
    {
        return $this->setStatus(true);
    }
}
