<?php

namespace ScottRobertson\Scrutiny\Mock;

class Service
{
    public function getData($key)
    {
        return $key;
    }

    public function getTime()
    {
        return time();
    }

    public function getStatusMessage()
    {
        return 'up';
    }
}
