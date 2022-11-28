<?php

// PHP Web Proxy
// Copyright (c)2022 - RND ICWR - Afrizal F.A

namespace webProxy;

class PROXY
{

    public function __construct()
    {

        $headers = [];

        foreach(getallheaders() as $key => $value)
        {

            $headers []= $key . ": " . $value;

        }

        $this->headers = $headers;

    }

    public function requester($url, $method, $body = null)
    {

        $c = curl_init();

        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($c, CURLOPT_HTTPHEADER, $this->headers);

        if (!empty($body)) {

            curl_setopt($c, CURLOPT_POSTFIELDS, $body);

        }

        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($c);
        curl_close($c);

        return $response;

    }

    public function forwarder()
    {


        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if (!empty(file_get_contents("php://input"))) {

            $body = file_get_contents("php://input");

        } else {

            $body = null;

        }

        $resp = (!empty($_GET['url'])) ? $this->requester($_GET['url'], $requestMethod, $body) : false;

        return $resp;

    }

}
