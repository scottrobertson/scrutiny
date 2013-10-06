<?php

namespace ScottRobertson\Scrutiny\Reporter;

class Null extends Base
{
    public function __construct(array $events = array('down'))
    {
        $this->subscribe($events);
    }

    public function report()
    {
        return true;
    }
}
