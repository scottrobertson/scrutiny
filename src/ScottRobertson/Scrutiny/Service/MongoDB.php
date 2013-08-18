<?php

namespace ScottRobertson\Scrutiny\Service;

class MongoDB extends Base
{
    private $connection_string;
    public function __construct($connection_string = null)
    {
        $this->connection_string = $connection_string;

        $this->setName('MongoDB');
        $this->setInterval(5);
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
