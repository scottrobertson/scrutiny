<?php

namespace ScottRobertson\Scrutiny\Mock;

class Service extends \ScottRobertson\Scrutiny\Service\Base
{
    public function getData($key = false)
    {
        return $key;
    }

    public function getTime()
    {
        return time();
    }

    public function getMessageFromEvent()
    {
        return 'up';
    }

    public function getName()
    {
        return 'service';
    }
}
