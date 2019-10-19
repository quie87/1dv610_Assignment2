<?php

namespace TodoModel;

class Todo
{
    private $userName;
    private $todo;
    private $ID;

    public function __construct(string $userName, string $todo, string $ID = '')
    {
        $this->userName = $userName;
        $this->todo = htmlentities($todo);
        $this->ID = $ID;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function getTodoName()
    {
        return $this->todo;
    }

    public function getId()
    {
        return $this->Id;
    }
}