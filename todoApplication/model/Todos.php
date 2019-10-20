<?php

namespace TodoModel;

class Todos
{
    private $Database;

    public function __construct()
    {
        $this->Database = new \TodoModel\Database();
    }

    public function getTodos()
    {
        return $this->Database->getTodos();
    }

    public function saveTodo ($todo)
    {
        $this->Database->saveTodo($todo);
    }

    public function deleteTodo (string $ID)
    {
        $this->Database->deleteTodo($ID);
    }
}