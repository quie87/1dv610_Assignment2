<?php

class TodoController {
    private $database;
    private $layoutView;
    private $todoView;

    public function __construct()
    {
        $this->database = new \TodoModel\PersistantDataModel();

        $this->layoutView = new \Todoview\LayoutView();
        $this->todoView = new \TodoView\TodoView($this->database);
    }

    public function run() {
        $this->changeState();
        $this->generateOutput();
    }

    private function changeState() {
        $userWantToAddTodo = $this->todoView->doUserWantToAddNewTodo();
        $userWantToDeleteTodo = $this->todoView->userClickedDelete();
        // var_dump($userWantToDeleteTodo);

        if ($userWantToAddTodo)
        {
            $this->addTodo();
        }

        if ($userWantToDeleteTodo)
        {
            $this->deleteTodo();
        }
    }

    private function generateOutput() {
        $this->layoutView->render($this->todoView);
    }

    private function addTodo() 
    {
        $newTodo = $this->todoView->getTodoItem();
        $this->database->saveTodo($newTodo);
    }

    private function deleteTodo()
    {
        $todoToDeleteByName = $this->todoView->getTodoToDelete();
        // print_r($todoToDeleteByName);
        $this->database->deleteTodoByName($todoToDeleteByName);
    }
}