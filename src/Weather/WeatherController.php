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
class WeatherController implements ContainerInjectableInterface
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
        $data["ip"] = "";
        $page->add('weather/index', $data);


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
    public function searchCordActionPost() : object
    {
        $request = $this->di->request;
        $wcL = $this->di->weather;
        $lat = $request->getPost("lat");
        $long = $request->getPost("long");

        $data["lat"] = $lat;
        $data["long"] = $long;
        $data["lat1"] = floatval($lat) - 1;
        $data["long1"] = floatval($long) - 2;
        $data["lat2"] = floatval($lat) + 1;
        $data["long2"] = floatval($long) + 2;
        $weather = $wcL->getWeather($lat, $long);
        $today = $weather[0];
        \array_splice($weather, 0, 1);

        $data["weather"] = $weather;
        $data["today"] = $today;

        $page = $this->di->get("page");
        $page->add('weather/index', $data);
        if (count($weather[0]) > 2) {
            $page->add('weather/result', $data);
        } else {
            $page->add('weather/fail');
        }
        $title = "IP-validate";

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
    public function searchIpActionPost() : object
    {
        $ipStack = new \Anax\Ip2\IpStack();
        $request = $this->di->request;
        $ipAd = $request->getPost("ip");
        $ipW = $ipStack->getInfo($ipAd);
        $lat = $ipW["lat"];
        $long = $ipW["long"];
        $wcL = $this->di->weather;
        

        $data["lat"] = $lat;
        $data["long"] = $long;
        $data["lat1"] = floatval($lat) - 1;
        $data["long1"] = floatval($long) - 2;
        $data["lat2"] = floatval($lat) + 1;
        $data["long2"] = floatval($long) + 2;
        $weather = $wcL->getWeather($lat, $long);
        $today = $weather[0];
        \array_splice($weather, 0, 1);

        $data["weather"] = $weather;
        $data["today"] = $today;

        $page = $this->di->get("page");
        $page->add('weather/index', $data);
        if (count($weather[0]) > 2) {
            $page->add('weather/result', $data);
        } else {
            $page->add('weather/fail');
        }
        $title = "IP-validate";

        return $page->render([
            "title" => $title,
        ]);
    }
}
