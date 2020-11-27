<?php

namespace Anax\Weather;

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
class WeatherControllerApi implements ContainerInjectableInterface
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
        $title = "Weather API";
        $page = $this->di->get("page");
        $url = "{$this->di->request->getBaseUrl()}/weather-api";
        $escapedUrl = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');

        $data["url"] = $escapedUrl ?? null;

        $page->add('weather/api-index', $data);
        return $page->render([
            "title" => $title,
        ]);
    }
    public function searchCordActionPost() : array
    {
        $request = $this->di->request;
        $wcL = $this->di->weather;
        $lat = $request->getPost("lat");
        $long = $request->getPost("long");
        $weather = $wcL->getWeather($lat, $long);

        return [$weather];
    }

        /**
     *
     *
     *
     *
     *
     * @return object
     */
    public function searchIpActionPost() : array
    {
        $ipStack = new \Anax\Ip2\IpStack();
        $request = $this->di->request;
        $ipAd = $request->getPost("ip");
        $ipA = $ipStack->getInfo($ipAd);
        $lat = $ipA["lat"];
        $long = $ipA["long"];
        $wcL = $this->di->weather;
        $weather = $wcL->getWeather($lat, $long);

        return [$weather];
    }
}
