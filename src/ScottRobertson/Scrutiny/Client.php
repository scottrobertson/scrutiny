<?php

namespace ScottRobertson\Scrutiny;

class Client
{
    private $services = array();
    private $reporters = array();

    public function addService($service)
    {
        $this->services[] = $service;
    }

    public function addReporter($reporter)
    {
        $this->reporters[] = $reporter;
    }

    public function getServices()
    {
        return $this->services;
    }

    public function getReporters()
    {
        return $this->reporters;
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

    public function report(\ScottRobertson\Scrutiny\Service\Base $service)
    {
        foreach ($this->reporters as $report) {
            if ($report->subscribed($service->getEvent())) {
                $report->report($service, $this->hostname);
            }
        }
    }
}
