<?php

namespace phpBoilerplate\core;

/**
 * This is the "base controller class". All other "real" controllers extend this class.
 */
class controller
{
    /**
     * @var null Database Connection
     */
    public $db = null;

    /**
     * @var null Path to current folder
     */
    private $dir = null;

    /**
     * Whenever a controller is created, open a database connection too. The idea behind is to have ONE connection
     * that can be used by multiple models (there are frameworks that open one connection per model).
     */
    function __construct()
    {
        $this->openDatabaseConnection();
        $this->getDir();
    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection()
    {
        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING);

        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        $this->db = new \PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
    }

    /**
     * Get the current dir using reflection
     * @link http://stackoverflow.com/questions/3896384/php-how-to-get-dir-of-child-class
     */
    private function getDir()
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
    public function loadModel($modelName)
    {
        // return new model (and pass the database connection to the model)
        return new $modelName($this->db);
    }

    public function render($view, $data_array = array())
    {
        // load Twig, the template engine
        // @see http://twig.sensiolabs.org
        $twig_loader = new \Twig_Loader_Filesystem(array($this->dir . '/../views/', ROOT_DIR .'/src/phpBoilerplate/core/templates/'));
        $twig = new \Twig_Environment($twig_loader);

        // render a view while passing the to-be-rendered data
        echo $twig->render($view . PATH_VIEW_FILE_TYPE, $data_array);
    }
}
