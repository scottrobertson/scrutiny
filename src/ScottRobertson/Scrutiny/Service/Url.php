<?php

namespace ScottRobertson\Scrutiny\Service;

class Url extends Base
{
    private $url = array();

    public function __construct($url)
    {
        $this->url = $url;

        $this->setName('Url');
        $this->setInterval(5);
    }

    public function getStatus()
    {
        return $this->setStatus($this->isOnline($this->url));
    }

    public function isOnline($url)
    {
        $curl = curl_init($url);
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_CONNECTTIMEOUT => 10,
                CURLOPT_HEADER => true,
                CURLOPT_RETURNTRANSFER => true
            )
        );

        $response = curl_exec($curl);
        $header = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);
        return $header < 400;
    }
}
