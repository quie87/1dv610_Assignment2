<?php

require_once('controller/TodoController.php');

require_once('view/LayoutView.php');
require_once('view/TodoView.php');

require_once('model/TodoModel.php');
require_once('model/PersistantDataModel.php');


class TodoApp {
    private $todoController;

    public function __construct()
    {
        $this->todoController = new TodoController();
    }

    public function runMainController()
    {
        $this->todoController->run();
    }

    public function getMainController()
    {
        return $this->todoController;
    }
}