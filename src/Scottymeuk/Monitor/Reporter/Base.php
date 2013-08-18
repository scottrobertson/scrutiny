<?php

namespace Scottymeuk\Monitor\Reporter;

class Base
{
    public function getMessage($service, $hostname)
    {
        $message = '[' . $hostname . '] ';
        if ($service->getStatus()) {
            $message .= $service->getUpMessage();
        } else {
            $message .= $service->getDownMessage();
        }

        return $message;
    }

    public function report($service, $hostname)
    {
        $message = $this->getMessage($service, $hostname);
        $this->sender($message);
    }
}
