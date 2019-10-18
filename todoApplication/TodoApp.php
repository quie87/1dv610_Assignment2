<?php

require_once('controller/MainController.php');
require_once('controller/TodoController.php');

require_once('view/LayoutView.php');
require_once('view/TodoView.php');

require_once('model/TodoModel.php');
require_once('model/PersistantDataModel.php');


class TodoApp {
    private $mainController;

    public function __construct()
    {
        $this->mainController = new \TodoController\MainController();
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