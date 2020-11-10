<?php

namespace Anax\Ip;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class IpApiController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    // /**
    //  * This is the index method action, it handles:
    //  * ANY METHOD mountpoint
    //  * ANY METHOD mountpoint/
    //  * ANY METHOD mountpoint/index
    //  *
    //  * @return string
    //  */
    // public function initAction() : object
    // {
    //     // init session for game start

    //     $this->app->session->set("game", new DiceGame());

    //     return $this->app->response->redirect("diceC/play");
    // }

    // /**
    //  * This is the index method action, it handles:
    //  * ANY METHOD mountpoint
    //  * ANY METHOD mountpoint/
    //  * ANY METHOD mountpoint/index
    //  *
    //  * @return string
    //  */
    public function indexActionGet() : object
    {
        $title = "IP-validate";
        $page = $this->di->get("page");
        $url = "{$this->di->request->getBaseUrl()}/api/ip";

        $escapedUrl = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');

        $data["url"] = $escapedUrl ?? null;

        $page->add('ip/api-index', $data);
        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     *
     *
     *
     *
     *
     * @return object
     */
    public function indexActionPost() : array
    {
        $request = $this->di->request;
        $ipAd = $request->getPost("ip");

        if (filter_var($ipAd, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $res = "true";
            $type = 'ipv6';
            $host = gethostbyaddr($ipAd);
        } elseif (filter_var($ipAd, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $res = "true";
            $type = 'ipv4';
            $host = gethostbyaddr($ipAd);
        } else {
            $res = "false";
            $host = "invalid";
            $type = 'invalid';
        }
        $data = [
            "valid" => $res,
            "ip" => $ipAd,
            "type" => $type,
            "domain" => $host
        ];

        return [$data];
    }
}
