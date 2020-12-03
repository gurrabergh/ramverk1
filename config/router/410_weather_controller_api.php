<?php

/**
 * Load the ip controller.
 */

return [
    "routes" => [
        [
            "info" => "Weather-controller api.",
            "mount" => "weather-api",
            "handler" => "\Anax\Weather\WeatherControllerApi",
        ],
    ]
];
