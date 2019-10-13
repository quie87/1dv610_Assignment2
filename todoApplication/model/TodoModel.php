<?php

namespace TodoModel;

class TodoModel
{
    private $todo;

    public function __construct(string $todo)
    {
        $this->todo = $todo;
    }

    public function getTodo()
    {
        return $this->todo;
    }
}