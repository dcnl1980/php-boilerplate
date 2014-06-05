<?php

namespace phpBoilerplate\core;

/**
 * Class services
 * @package phpBoilerplate\core
 */
class services
{
    /**
     * @var array
     */
    private $services = array();

    /**
     * Register a new service
     * @param array $service
     */
    public function registerService(array $service)
    {
       $this->services[] = $service;
    }

    /**
     * Get a class registered as service
     * @param $service
     *
     * @return mixed
     */
    public function getService($service)
    {
        foreach($this->services as $aService) {
            if($aService[0] == $service) {
                return $aService[1];
            }
        }
    }
}