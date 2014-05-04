<?php

namespace phpBoilerplate\core;

class application
{
    /** @var array the requested url. Splited at / */
    private $urlParts = array();

    /** @var null The controller */
    private $controller = null;

    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method
     */
    public function __construct()
    {
        // create array with URL parts in $url
        $this->splitUrl();

        // get class and methode to call
        $route = $this->getRoute();

        /**
         * example: if controller would be "car" and the method would be "open", then this lines would translate into:
         * $this->car = new car();
         * $this->car->open($this->urlParts);
         */
        $this->controller = new $route[0];
        $this->controller->{$route[1]}($this->urlParts);

    }

    /**
     * Get and split the URL
     */
    private function splitUrl()
    {

        if($_SERVER['REQUEST_URI'] == '/') {
            // nothing special requested. We show the homepage
            $this->urlParts[0] = 'home';
        } else {
            // split URL
            $this->urlParts = explode('/', ltrim($_SERVER['REQUEST_URI'], '/'));
        }

    }

    /**
     * get the routing information for a url
     * @todo include routing informations somewhere else
     */
    private function getRoute()
    {
        // include routing information
        require ROOT_DIR . '/src/config/routing.php';

        for ($i = sizeof($this->urlParts); $i > 0; $i--) {
            $compare = '';
            for ($ii = 0; $ii < $i; $ii++) { 
                $compare = '/' . $this->urlParts[$i-$ii-1] . $compare;
            }
            if(isset($routes[$compare])) {
                $return = explode(':', $routes[$compare]);
                if (sizeof($return) == 1) {
                    // @see http://davidwalsh.name/php-shorthand-if-else-ternary-operators
                    $method = (isset($this->urlParts[1]) ? $this->urlParts[1] : 'index');
                    return array($routes[$compare], $method);
                }
                return $return;
            }
        }

        return false;
    }
}
