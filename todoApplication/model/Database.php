<?php

namespace TodoModel;

use Exception;

class Database
{
    private $connection;
    private $settings;

    private static $LOCALHOST = 'localhost';
    private static $SERVER_NAME = 'SERVER_NAME';

    public function __construct()
    {
        $hostname = $_SERVER[self::$SERVER_NAME];

        if ($hostname == self::$LOCALHOST) {
          $this->settings = new \TodoModel\LocalSettings();
        } else {
          $this->settings = new \TodoModel\ProductionSettings();
        }

        $this->connection = new \mysqli(
          $this->settings->DB_HOST,
          $this->settings->DB_USERNAME,
          $this->settings->DB_PASSWORD,
          $this->settings->DB_NAME
        );

        // TODO: Implement correct error handling
        if ($this->connection->connect_error) {
            throw new Exception();
        }
    }

    public function saveTodo($newTodo) 
    {
        $author = mysqli_real_escape_string($this->connection, $newTodo->getUserName());
        $title = mysqli_real_escape_string($this->connection, $newTodo->getTodoName());

        $query = "INSERT INTO todos(author, title) VALUES('$author','$title')";

        // TODO: Implement correct error handling
        if (!mysqli_query($this->connection, $query))
        {
            throw new Exception();
        }
    }

    public function getTodos()
    {
        $query = 'SELECT * FROM todos';

        // Get result
        $result = mysqli_query($this->connection, $query);

        // Fetch data
        $todos = mysqli_fetch_all($result, MYSQLI_ASSOC);

        mysqli_free_result($result);
        mysqli_close($this->connection);

        return $todos;
    }

    public function deleteTodo($todoId)
    {
        $delete_id = mysqli_real_escape_string($this->connection, $todoId);

        $query = "DELETE FROM todos WHERE id = {$delete_id}";

        // TODO: Implement correct error handling
        if (!mysqli_query($this->connection, $query))
        {
            throw new Exception();
        }
    }
}