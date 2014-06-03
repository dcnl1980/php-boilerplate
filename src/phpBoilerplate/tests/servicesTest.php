<?php

namespace phpBoilerplate\tests;

use phpBoilerplate\core\services;

class demoService
{
    public function __construct($testval)
    {
        $this->testval = $testval;
    }

    public function getTestVal()
    {
        return $this->testval;
    }
}

class servicesTest extends \PHPUnit_Framework_TestCase {

    public function testServiceSetupAndGet()
    {
        $demoService = new demoService("phpBoilerplate");
        $testServices= array("demoService", $demoService);

        $services = new services;
        $services->registerService($testServices);

        $this->assertCount(1, $services->getServices());
        $this->assertInstanceOf("\\phpBoilerplate\\tests\\demoService", $services->getService("demoService"));

        $service = $services->getService("demoService");
        $this->assertEquals("phpBoilerplate", $service->getTestVal());
    }

}
 