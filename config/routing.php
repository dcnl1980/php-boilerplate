<?php

/**
 * At the moment we use VERY simple rounting config here.
 * There is one array to specify which url maps to which methode.
 */

$routes = array(
    "/home" => "acme\home\controller\home",
    "/songs" => "acme\songs\controller\songs"
);