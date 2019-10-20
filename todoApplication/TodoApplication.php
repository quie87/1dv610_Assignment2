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

    public function runMainController()
    {
        $this->mainController->run();
    }

    public function getMainController()
    {
        return $this->mainController;
    }
}