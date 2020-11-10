<?php
/**
 * Load the ip controller.
 */
return [
    "routes" => [
        [
            "info" => "IP-api-controller.",
            "mount" => "ip-api",
            "handler" => "\Anax\Ip\IpApiController",
        ],
    ]
];
