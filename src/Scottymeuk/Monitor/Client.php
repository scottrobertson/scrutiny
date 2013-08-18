<?php

namespace Scottymeuk\Monitor;

class Client
{
    private $services = array();
    private $reporters = array();
    private $hostname = null;

    public function __construct($hostname, Array $services, Array $reporters)
    {
        $this->services = $services;
        $this->reporters = $reporters;
        $this->hostname = $hostname;
    }

    public function watch($global_interval = 20)
    {
        while (true) {
            foreach ($this->services as $service) {
                if ($service->checkable()) {
                    $service->getStatus();
                    if ($service->sendReport()) {
                        $this->report($service);
                    }
                }
            }

            sleep($global_interval);
        }
    }


    public function report(\Scottymeuk\Monitor\Service\Base $service)
    {
        foreach ($this->reporters as $report) {
            $report->report($service, $this->hostname);
        }
    }
}
