<?php

namespace phpBoilerplate\core;

class application
{
    /** @var array the requested url. Splited at / */
    private $urlParts = array();

    /** @var null The controller */
    private $controller = null;

    private $config = null;

    private $services = null;

    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method
     */
    public function __construct(config $config)
    {
        $this->config = $config;
    }

    public function handleRequest()
    {
        // create array with URL parts in $url
        $this->splitUrl();

        // get class and method to call
        $route = $this->getRoute();

        // setup registered services
        $this->setupServices();

        /**
         * example: if controller would be "car" and the method would be "open", then this lines would translate into:
         * $this->controller = new car($this->config, $this->services);
         * $this->controller->open($this->urlParts);
         */
        $this->controller = new $route[0]($this->config, $this->services);
        $this->controller->{$route[1]}($this->urlParts);
    }

    private function setupServices()
    {
        $this->services = new services();

        //Database
        $options = array(\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING);
        $db = new \PDO($this->config->getConfigValue("dbType") .
                            ':host=' . $this->config->getConfigValue("dbHost") .
                            ';dbname=' . $this->config->getConfigValue("dbName"),
                            $this->config->getConfigValue("dbUser"),
                            $this->config->getConfigValue("dbPass"),
                            $options
                    );

        $this->services->registerService(array("database", $db));
    }

    /**
     * Get and split the URL
     */
    private function splitUrl()
    {
        // We don't want GET parameters here
        $request = explode("?", $_SERVER['REQUEST_URI']);
        if($request [0] == '/') {
            // nothing special requested. We show the homepage
            $this->urlParts[0] = 'home';
        } else {
            // split URL
            $this->urlParts = explode('/', ltrim($_SERVER['REQUEST_URI'], '/'));
        }

    }

    /**
     * get the routing information for a url
     * @todo include routing information somewhere else
     */
    private function getRoute()
    {
        // include routing information
        require $this->config->getConfigValue("rootDir") . '/src/config/routing.php';

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
