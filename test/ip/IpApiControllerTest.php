<?php

namespace Anax\Ip;

use PHPUnit\Framework\TestCase;
use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;

/**
 * Example test class.
 */
class IpApiControllerTest extends TestCase
{
    private $controller;
    private $di;
     /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        // Setup di
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $this->di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // View helpers uses the global $di so it needs its value
        $di = $this->di;

        // Setup the controller
        $this->controller = new IpApiController();
        $this->controller->setDI($this->di);
        //$this->controller->initialize();
    }

    public function testInitAction()
    {
        $this->di->get("url")->create("api/ip");
        $res = $this->controller->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    public function testInvalidIp()
    {
        $request = $this->di->get("request");
        $request->setPost("ip", "test");

        $res = $this->controller->IndexActionPost();
        $valid = $res[0]["valid"];
        $this->assertEquals("false", $valid);
    }

    public function testValidIp4()
    {
        $request = $this->di->get("request");
        $request->setPost("ip", "8.8.8.8");

        $res = $this->controller->IndexActionPost();
        $valid = $res[0]["valid"];
        $this->assertEquals("true", $valid);
    }

    public function testValidIp6()
    {
        $request = $this->di->get("request");
        $request->setPost("ip", "2001:4860:4860::8888");

        $res = $this->controller->IndexActionPost();
        $valid = $res[0]["valid"];
        $this->assertEquals("true", $valid);
    }
}
