<?php

namespace TodoController;

class MainController {
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

    public function changeState() {
        if ($this->todoView->doUserWantToAddNewTodo())
        {
            $this->addTodo();
        }

        if ($this->todoView->userClickedDelete())
        {
            $this->deleteTodo();
        }
    }

    public function getHTML()
    {
        return $this->todoView;
    }

    public function generateOutput() {
        $this->layoutView->render($this->getHTML());
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