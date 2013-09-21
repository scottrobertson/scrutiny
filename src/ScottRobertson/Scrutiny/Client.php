<?php

namespace ScottRobertson\Scrutiny;

class Client
{
    /**
     * Array of services we wish to watch
     * @var array
     */
    protected $services = array();

    /**
     * Array of reporters we wish to send responses
     * @var array
     */
    protected $reporters = array();

    /**
     * Add a service to our internal array
     * @param Object $service
     */
    public function addService($service)
    {
        if (! method_exists($service, 'getStatus')) {
            throw new \Exception('Method: getStatus() does not exist');
        }

        $this->services[] = $service;
    }

    /**
     * Add a reporter to our internal array
     * @param Object $reporter
     */
    public function addReporter($reporter)
    {
        if (! method_exists($reporter, 'report')) {
            throw new \Exception('Method: report() does not exist');
        }

        $this->reporters[] = $reporter;
    }

    /**
     * Returns an array of all current services
     * @return array
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * Returns an array of all current reporters
     * @return array
     */
    public function getReporters()
    {
        return $this->reporters;
    }

    /**
     * This is the main method to watch all our services.
     */
    public function watch()
    {
        while (true) {
            foreach ($this->services as $service) {
                if ($service->checkable()) {
                    $service->getStatus();
                    $this->report($service);
                }
            }

            sleep(1);
        }
    }

    /**
     * Report the status of our service to each of our reporters
     * @param  ScottRobertsonScrutinyServiceBase $service
     */
    public function report(\ScottRobertson\Scrutiny\Service\Base $service)
    {
        foreach ($this->reporters as $report) {
            if ($report->subscribed($service->getEvent())) {
                $report->report($service);
            }
        }
    }
}
