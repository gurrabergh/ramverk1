<?php
/**
 * Load the ip controller.
 */
return [
    "routes" => [
        [
            "info" => "Weather-controller.",
            "mount" => "weather",
            "handler" => "\Anax\Weather\WeatherController",
        ],
    ]
];
