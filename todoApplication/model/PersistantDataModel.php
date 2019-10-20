<?php

namespace TodoModel;

use mysqli;

class PersistantDataModel
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
          $this->settings->server_name,
          $this->settings->db_name,
          $this->settings->db_password,
          $this->settings->database
        );

        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function saveTodo($newTodo) 
    {

        $author = mysqli_real_escape_string($this->connection, $newTodo->getUserName());
        $title = mysqli_real_escape_string($this->connection, $newTodo->getTodoName());

        $query = "INSERT INTO todos(author, title) VALUES('$author','$title')";

        // Remove this later or throw a real error
        if (!mysqli_query($this->connection, $query))
        {
            echo 'Error: ' . mysqli_error($this->connection);
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

        if (!mysqli_query($this->connection, $query))
        {
            echo 'ERROR: ' . mysqli_error($this->connection);
        }
    }
}