<?php

namespace TodoController;

use Exception;
use TodoModel\PersistantDataModel;

class TodoController 
{
    private $view;
    private $persistantData;

    public function __construct(\TodoView\TodoView $view, \TodoModel\PersistantDataModel $database)
    {
        $this->view = $view;

        $this->persistantData = $database;
    }

    public function addTodo() 
    {
        $newTodo = $this->view->getTodoItem();
        $this->persistantData->saveTodo($newTodo);
    }

    public function deleteTodo()
    {
        $todoToDelete = $this->view->getTodoToDelete();
        throw new Exception("Not implemented yet");
    }
}