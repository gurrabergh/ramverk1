<?php

namespace Anax\Ip2;

class IpStack
{
    public function getInfo($ipAd)
    {
        $ipVal = new IpValidate();

        if ($ipVal->validate($ipAd)) {
            $key = "299a8efa45108d9ed496c061839b0232";
        
            $cHan = curl_init();
    
            curl_setopt($cHan, CURLOPT_URL, "http://api.ipstack.com/{$ipAd}?access_key={$key}");
            curl_setopt($cHan, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($cHan, CURLOPT_HEADER, false);
    
            $res = json_decode(curl_exec($cHan), true);
    
            $data["ip"] = $res["ip"];
            $data["type"] = $res["type"];
            $data["country"] = $res["country_name"];
            $data["city"] = $res["city"];
            $data["lat"] = $res["latitude"];
            $data["long"] = $res["longitude"];
    
            curl_close($cHan);
        } else {
            $data["ip"] = $ipAd;
            $data["type"] = "Ogiltig";
            $data["country"] = "Inget";
            $data["city"] = "Ingen";
            $data["lat"] = "";
            $data["long"] = "";
        }
        return $data;
    }
}
