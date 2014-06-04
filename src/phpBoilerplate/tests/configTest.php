<?php

namespace phpBoilerplate\tests;

use phpBoilerplate\core\config;

class configTest extends \PHPUnit_Framework_TestCase {

    public function testYamlParser()
    {
        $expectedArray = array(array("test", "array"), "test");

        $config = new config();
        $config->parseYamlFile(dirname(__FILE__)."/configTest.yaml");

        $this->assertEquals("test", $config->getConfigValue("yamlstring"));
        $this->assertEquals($expectedArray, $config->getConfigValue("yamlarray"));

    }

    public function testConfigAddValue()
    {
        $config = new config();
        $config->setConfigValue("hello", "world");

        $this->assertEquals("world", $config->getConfigValue("hello"));
    }

}
 