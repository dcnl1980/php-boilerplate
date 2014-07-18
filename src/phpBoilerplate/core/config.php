<?php

namespace phpBoilerplate\core;

use \Symfony\Component\Yaml\Parser;

/**
 * Class config
 * @package phpBoilerplate\core
 */
class config
{
    /**
     * @var array
     */
    private $config = array();

    /**
     * @var \Symfony\Component\Yaml\Parser
     */
    private $yaml;

    /**
     *
     */
    public function __construct()
    {
        $this->yaml = new Parser();
    }

    /**
     * Parse a yaml string as config
     * @param $yaml
     */
    public function parseYaml($yaml)
    {
        foreach($this->yaml->parse($yaml) as $key=>$config) {
            $this->config[$key] = $config;
        }
    }

    /**
     * Parse all files in a folder as yaml
     * @param $path
     */
    public function parseYamlFolder($path)
    {
        foreach(scandir($path) as $file){
            if(is_file($path . "/" . $file) && substr($file, -4) == ".yml") {
                $this->parseYamlFile($path . "/" . $file);
            }
        }
    }

    /**
     * Parse a yaml file
     * @param $file
     */
    public function parseYamlFile($file)
    {
        $this->parseYaml(file_get_contents($file));
    }

    /**
     * Manually set a config value
     * @param $name
     * @param $value
     */
    public function setConfigValue($name, $value)
    {
        $this->config[$name] = $value;
    }

    /**
     * Return the value of a config variable
     * @param $name
     *
     * @return mixed
     */
    public function getConfigValue($name)
    {
        return $this->config[$name];
    }
} 