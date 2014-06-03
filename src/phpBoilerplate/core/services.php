<?php

namespace phpBoilerplate\core;

class services
{
    private $services = array();

    public function registerService(array $service)
    {
       $this->services[] = $service;
    }

    public function getServices()
    {
        $return = array();

        foreach($this->services as $service)
        {
            $return[] = $service[1];
        }

        return $return;
    }

    public function getService($service)
    {
        foreach($this->services as $aService) {
            if($aService[0] == $service) {
                return $aService[1];
            }
        }
    }
}