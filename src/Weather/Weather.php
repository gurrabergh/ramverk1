<?php

namespace Anax\Weather;

class Weather
{
    private $key;

    public function setApiKey($key)
    {
        $this->key = $key["config"]["key"];
        return $this;
    }


    public function getWeather($lat, $lon)
    {
    
        $muH = curl_multi_init();
        $res = [];
        $handles = [];
        $handles[0] = curl_init();
        curl_setopt($handles[0], CURLOPT_URL, "https://api.openweathermap.org/data/2.5/onecall?lat=${lat}&lon=${lon}&exclude=hourly,minutely&appid={$this->key}&units=metric&lang=sv");
        curl_setopt($handles[0], CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handles[0], CURLOPT_HEADER, false);
        curl_multi_add_handle($muH, $handles[0]);

        for ($i=1; $i < 6; $i++) {
            $handles[$i] = curl_init();
            $days = "-${i} days";
            $time = date(strtotime($days));
            curl_setopt($handles[$i], CURLOPT_URL, "https://api.openweathermap.org/data/2.5/onecall/timemachine?lat=${lat}&lon=${lon}&dt=${time}&exclude=hourly,minutely&appid={$this->key}&units=metric&lang=sv");
            curl_setopt($handles[$i], CURLOPT_RETURNTRANSFER, true);
            curl_setopt($handles[$i], CURLOPT_HEADER, false);
            curl_multi_add_handle($muH, $handles[$i]);
        }


        

        $running = 0;
        do {
            \curl_multi_exec($muH, $running);
        } while ($running > 0);

        foreach ($handles as $i => $handle) {
            $res[$i] = \json_decode(\curl_multi_getcontent($handle), true);
            \curl_multi_remove_handle($muH, $handle);
        }

        \curl_multi_close($muH);

        return $res;
    }
}
