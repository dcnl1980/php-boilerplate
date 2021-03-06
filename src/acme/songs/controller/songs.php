<?php

namespace acme\songs\controller;

use phpBoilerplate\core\controller;

/**
 * Class Songs
 * This is a demo class.
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class songs extends controller
{

    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/songs/index
     */
    public function index()
    {
        // load a model, perform an action, pass the returned data to a variable
        // NOTE: please write the name of the model "LikeThis"
        $songs_model = $this->loadModel('acme\songs\models\songsModel');
        $songs = $songs_model->getAllSongs();

        // load another model, perform an action, pass the returned data to a variable
        // NOTE: please write the name of the model "LikeThis"
        $stats_model = $this->loadModel('acme\songs\models\statsModel');
        $amount_of_songs = $stats_model->getAmountOfSongs();

        // render the view, pass the data
        $this->render('index', array('page_title' => 'Song list', 'songs' => $songs, 'amount_of_songs' => $amount_of_songs));
    }

    /**
     * ACTION: addSong
     * This method handles what happens when you move to http://yourproject/songs/addsong
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a song" form on songs/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to songs/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function addSong()
    {
        // if we have POST data to create a new song entry
        if (isset($_POST["submit_add_song"])) {
            // load model, perform an action on the model
            $songs_model = $this->loadModel('acme\songs\models\songsModel');
            $songs_model->addSong($_POST["artist"], $_POST["track"],  $_POST["link"]);
        }

        // where to go after song has been added
        header('location: ' . URL . 'songs/index');
    }

    /**
     * ACTION: deleteSong
     * This method handles what happens when you move to http://yourproject/songs/deletesong
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "delete a song" button on songs/index
     * directs the user after the click. This method handles all the data from the GET request (in the URL!) and then
     * redirects the user back to songs/index via the last line: header(...)
     * This is an example of how to handle a GET request.
     * @param array $urlParts The requested url. Splited at /
     */
    public function deleteSong($urlParts)
    {
        print_r($urlParts);
        // if we have an id of a song that should be deleted
        if (isset($urlParts[2])) {
            // load model, perform an action on the model
            $songs_model = $this->loadModel('acme\songs\models\songsModel');
            $songs_model->deleteSong($urlParts[2]);
        }

        // where to go after song has been deleted
        header('location: ' . $this->config->getConfigValue("url") . 'songs/index');
    }
}
