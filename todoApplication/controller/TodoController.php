<?php

namespace TodoController;

class TodoController
{
    private $view;
    private $todos;

    public function __construct(\TodoView\TodoView $view)
    {
        $this->view = $view; 
   
        $this->todos = new \TodoModel\Todos();
    }

    public function addTodo() 
    {
        $newTodo = $this->view->getTodoItem();
        $this->todos->saveTodo($newTodo);
    }

    public function deleteTodo()
    {
        $todoToDelete = $this->view->getTodoToDelete();
        // var_dump($todoToDelete);
        $this->todos->deleteTodo($todoToDelete);
    }
}