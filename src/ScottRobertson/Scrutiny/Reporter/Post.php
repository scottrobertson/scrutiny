<?php

namespace ScottRobertson\Scrutiny\Reporter;

class Post extends Base
{
    protected $url;
    protected $curl;

    public function __construct($url, array $events = array('down'))
    {
        $this->url = $url;
        $this->subscribe($events);
        $this->curl = curl_init($this->url);
    }

    public function report(\ScottRobertson\Scrutiny\Service\Base $service)
    {
        return $this->post(
            array(
                'title' => $service->getMessageFromEvent(),
                'message' => $service->getName() . ' returned ' . $service->getData('code'),
                'timestamp' => $service->getTime(),
                'url' => $service->getData('url')
            )
        );
    }

    private function post($data)
    {
        curl_setopt_array(
            $this->curl,
            array(
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => http_build_query($data)
            )
        );

        $response = curl_exec($this->curl);
        return $response;
    }

    public function __destruct()
    {
        curl_close($this->curl);
    }
}
