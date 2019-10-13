<?php

namespace TodoController;

use TodoModel\PersistantDataModel;

class TodoController 
{
    private $view;
    private $persistantData;

    public function __construct(\TodoView\TodoView $view)
    {
        $this->view = $view;

        $this->persistantData = new PersistantDataModel();
    }

    public function addTodo() 
    {
        $newTodo = $this->view->getTodoItem();
        $this->persistantData->saveTodo($newTodo);
    }
}