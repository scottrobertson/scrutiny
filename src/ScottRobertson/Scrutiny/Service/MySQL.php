<?php

namespace ScottRobertson\Scrutiny\Service;

class MySQL extends Base
{
    protected $options;
    public function __construct(Array $options)
    {
        $this->options = $options;
        $this->setName('MySQL');
    }

    public function getStatus()
    {
        try {
            $dsn = 'mysql:host=' . $this->options['host'];
            $dbh = new \PDO($dsn, $this->options['username'], $this->options['password']);
        } catch (\PDOException $e) {
            return $this->setStatus(false);
        }

        return $this->setStatus(true);
    }
}
