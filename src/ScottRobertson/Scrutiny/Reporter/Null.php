<?php

namespace ScottRobertson\Scrutiny\Reporter;

class Null extends Base
{
    public function report($service)
    {
        return true;
    }
}
