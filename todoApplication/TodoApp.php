<?php

require_once('controller/TodoController.php');

require_once('view/LayoutView.php');
require_once('view/TodoView.php');

require_once('model/TodoModel.php');
require_once('model/PersistantDataModel.php');


class TodoApp {
    public function run() 
    {
        $controller = new TodoController();
        $controller->run();
    }
}