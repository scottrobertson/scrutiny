<?php

namespace ScottRobertson\Scrutiny\Service;

class Http extends Base
{
    protected $url = array();
    public function __construct($url)
    {
        $this->url = $url;
        $this->setName('HTTP');
        $this->setData('url', $this->url);
    }

    public function getStatus()
    {
        $online = $this->isOnline($this->url);
        $this->setStatus($online);
        return $this->status;
    }

    protected function isOnline($url)
    {
        $curl = curl_init($url);
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_CONNECTTIMEOUT => 2,
                CURLOPT_HEADER => true,
                CURLOPT_RETURNTRANSFER => true
            )
        );

        curl_exec($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $this->setData('code', $code);
        return (bool) preg_match('/^[23]{1}[\d]{2}$/', $code);
    }
}
