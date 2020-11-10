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
class IpController implements ContainerInjectableInterface
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
    public function indexAction() : object
    {
        $title = "IP-validate";
        $page = $this->di->get("page");
        $page->add('ip/index');


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
    public function validateActionPost() : object
    {
        $request = $this->di->request;
        $ipAd = $request->getPost("ip");

        if (filter_var($ipAd, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $res = " is a valid ipv6 address with domain: ";
            $host = gethostbyaddr($ipAd);
        } elseif (filter_var($ipAd, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $res = " is a valid ipv4 address with domain: ";
            $host = gethostbyaddr($ipAd);
        } else {
            $res = " is an invalid ip adress.";
            $host = "";
        }
        $data["res"] = $res;
        $data["ip"] = $ipAd;
        $data["host"] = $host;
        $page = $this->di->get("page");
        $page->add('ip/index');
        $page->add('ip/result', $data);
        $title = "IP-validate";

        return $page->render([
            "title" => $title,
        ]);
    }
}
