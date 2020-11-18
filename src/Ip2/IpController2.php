<?php

namespace Anax\Ip2;

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
class IpController2 implements ContainerInjectableInterface
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
        $ipAd = new GetIp();
        $title = "IP-validate";
        $page = $this->di->get("page");
        $data["ip"] = $ipAd->getIp();
        $page->add('ip2/index', $data);


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

        $ipStack = new IpStack();

        $data = $ipStack->getInfo($ipAd);

        $page = $this->di->get("page");
        $page->add('ip2/index', $data);
        $page->add('ip2/result', $data);
        $title = "IP-validate";

        return $page->render([
            "title" => $title,
        ]);
    }
}
