<?php

namespace ScottRobertson\Scrutiny\Service;

class MongoDB extends Base
{
    protected $connection_string;
    public function __construct($connection_string = null)
    {
        $this->connection_string = $connection_string;
        $this->setName('MongoDB');
    }

    public function getStatus()
    {
        try {
            $mongo = new \MongoClient($this->connection_string);
        } catch (\Exception $e) {
            return $this->setStatus(false);
        }

        return $this->setStatus($mongo->connected);
    }
}
