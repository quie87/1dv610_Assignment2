<?php

namespace TodoController;

class TodoController 
{
    private $view;
    private $todoModel;

    public function __construct(\TodoView\TodoView $view,\TodoModel\TodoModel $todo)
    {
        $this->view = $view;
        $this->todoModel = $todo;
    }

    public function addTodo() {
        $newTodo = $this->view->getNewTodo();
        var_dump($newTodo);
    }
}