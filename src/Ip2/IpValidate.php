<?php

namespace Anax\Ip2;

class IpValidate
{
    public function validate($ipAd)
    {
        if (filter_var($ipAd, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return true;
        } elseif (filter_var($ipAd, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return true;
        } else {
            return false;
        }
    }
}
