<?php

namespace phpBoilerplate\core;

/**
 * This is the "base controller class". All other "real" controllers extend this class.
 */
class controller
{

    /**
     * @var null Path to current folder
     */
    protected $dir = null;

    protected $config = null;

    protected $services = null;

    /**
     * Whenever a controller is created, open a database connection too. The idea behind is to have ONE connection
     * that can be used by multiple models (there are frameworks that open one connection per model).
     */
    public function __construct(config $config, services $services)
    {
        $this->config = $config;
        $this->services = $services;
        $this->getDir();
    }

    /**
     * Get the current dir using reflection
     * @link http://stackoverflow.com/questions/3896384/php-how-to-get-dir-of-child-class
     */
    protected function getDir()
    {
        $info = new \ReflectionClass($this);
        $this->dir = dirname($info->getFileName());
    }

    /**
     * Load the model with the given name.
     * loadModel("SongModel") would include models/songmodel.php and create the object in the controller, like this:
     * $songs_model = $this->loadModel('SongsModel');
     * Note that the model class name is written in "CamelCase", the model's filename is the same in lowercase letters
     *
     * @param $modelName
     * @return object model
     */
    protected function loadModel($modelName)
    {
        // return new model (and pass the database connection to the model)
        return new $modelName($this->config, $this->services);
    }

    protected function render($view, $dataArray = array())
    {
        // add the site url as twig variable
        $dataArray["url"] = $this->config->getConfigValue("url");

        // load Twig, the template engine
        // @see http://twig.sensiolabs.org
        $twig_loader = new \Twig_Loader_Filesystem(array($this->dir . '/../views/', $this->config->getConfigValue("rootDir") .'/src/phpBoilerplate/core/templates/'));
        $twig = new \Twig_Environment($twig_loader);

        // render a view while passing the to-be-rendered data
        echo $twig->render($view . ".twig", $dataArray);
    }
}
