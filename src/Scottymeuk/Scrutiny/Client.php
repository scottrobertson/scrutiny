<?php

namespace Scottymeuk\Scrutiny;

class Client
{
    private $services = array();
    private $reporters = array();
    private $hostname = null;

    public function __construct($hostname)
    {
        $this->hostname = $hostname;
    }

    public function addService($service)
    {
        $this->services[] = $service;
    }

    public function addReporter($reporter)
    {
        $this->reporters[] = $reporter;
    }

    public function watch($global_interval = 20)
    {
        while (true) {
            foreach ($this->services as $service) {
                if ($service->checkable()) {
                    $this->report($service->getStatus());
                }
            }

            sleep($global_interval);
        }
    }


    public function report(\Scottymeuk\Scrutiny\Service\Base $service)
    {
        foreach ($this->reporters as $report) {
            if ($report->subscribed($service->getEvent())) {
                $report->report($service, $this->hostname);
            }
        }
    }
}
