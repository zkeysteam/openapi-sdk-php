<?php

namespace Zkeys\OpenApi\helps;

class CurlHelper
{
    /**
     * request
     * @author King
     *
     * @param string $url
     * @param string $method
     * @param null   $data
     * @param int    $timeout
     * @param array  $header
     *
     * @return mixed
     */
    public static function request($url, $method, $data = null, $timeout = 5, $header = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        if ($header) {
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        $result = curl_exec($ch);

        if (false === $result) {
            curl_getinfo($ch);
        }

        curl_close($ch);

        return $result;
    }

    /**
     * get
     * @author King
     *
     * @param string $url
     * @param int    $timeout
     * @param array  $header
     *
     * @return mixed
     */
    public static function get($url, $timeout, $header = [])
    {
        return self::request($url, 'GET', [], $timeout, $header);
    }

    /**
     * post
     * @author King
     *
     * @param string       $url
     * @param string|array $data
     * @param int          $timeout
     * @param array        $header
     *
     * @return mixed
     */
    public static function post($url, $data, $timeout = 5, $header = [])
    {
        return self::request($url, 'POST', $data, $timeout, $header);
    }
}