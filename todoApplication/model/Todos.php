<?php

namespace TodoModel;

class Todos
{
    private $persistantDataModel;

    public function __construct()
    {
        $this->persistantDataModel = new \TodoModel\PersistantDataModel();
    }

    public function getTodos()
    {
        return $this->persistantDataModel->getTodosArray();
    }

    public function saveTodo ($todo)
    {
        $this->persistantDataModel->saveTodo($todo);
    }
}