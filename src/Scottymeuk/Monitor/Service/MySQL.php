<?php

namespace Scottymeuk\Monitor\Service;

class MySQL extends Base
{
    private $options;
    public function __construct(Array $options)
    {
        $this->options = $options;

        $this->setName('MySQL');
        $this->setDownMessage('Ermahgerd merserquell ers dern');
        $this->setInterval(5);
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
