<?php

namespace TodoController;

class TodoController
{
    private $view;
    private $persistantData;

    public function __construct(\TodoModel\PersistantDataModel $persistantData, \TodoView\TodoView $view)
    {
        $this->view = $view; 
        $this->persistantData = $persistantData;   
    }

    public function addTodo() 
    {
        $newTodo = $this->view->getTodoItem();
        $this->persistantData->saveTodo($newTodo);
    }

    public function deleteTodo()
    {
        $todoToDeleteByName = $this->view->getTodoToDelete();
        // print_r($todoToDeleteByName);
        $this->persistantData->deleteTodoByName($todoToDeleteByName);
    }
}