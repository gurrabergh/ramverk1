<?php

namespace Anax\Ip2;

class GetIp
{
    public function getIp()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $userIp = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $userIp = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $userIp = $_SERVER['REMOTE_ADDR'] ?? "";
        }
        return $userIp;
    }
}
