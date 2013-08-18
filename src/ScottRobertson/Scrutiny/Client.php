<?php

namespace ScottRobertson\Scrutiny;

class Client
{
    private $services = array();
    private $reporters = array();

    public function addService($service)
    {
        if (! method_exists($service, 'getStatus')) {
            throw new \Exception('Method: getStatus() does not exist');
        }

        $this->services[] = $service;
    }

    public function addReporter($reporter)
    {
        if (! method_exists($reporter, 'report')) {
            throw new \Exception('Method: report() does not exist');
        }

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
                    $service->getStatus();
                    $this->report($service);
                }
            }

            sleep($global_interval);
        }
    }

    public function report(\ScottRobertson\Scrutiny\Service\Base $service)
    {
        foreach ($this->reporters as $report) {
            if ($report->subscribed($service->getEvent())) {
                $report->report($service);
            }
        }
    }
}
