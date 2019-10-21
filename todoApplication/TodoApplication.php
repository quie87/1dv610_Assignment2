<?php

require_once('LocalSettings.php');
require_once('ProductionSettings.php');

require_once('controller/MainController.php');
require_once('controller/TodoController.php');

require_once('model/Todo.php');
require_once('model/Todos.php');
require_once('model/Database.php');

require_once('view/LayoutView.php');
require_once('view/TodoView.php');


class TodoApplication 
{
    private $mainController;
    private $authController;

    public function __construct($authController)
    {
        $this->authController = $authController;
        $this->mainController = new \TodoController\MainController($authController);
    }

    /**
     * Function to be called if the application is to be runned on its own
     * @return controller\MainController - And calls its Run function
     */
    public function runMainController()
    {
        $this->mainController->run();
    }
    
    /**
     * Funktion to be called if the application is to be user together with
     * a nother application.
     * @return controller\MainController
     */
    public function getMainController()
    {
        return $this->mainController;
    }
}