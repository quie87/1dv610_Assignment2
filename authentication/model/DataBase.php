<?php

namespace model;

use mysqli;

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
          $this->settings = new \LocalSettings();
        } else {
          $this->settings = new \ProductionSettings();
        }

        $this->connection = new \mysqli(
          $this->settings->DB_HOST,
          $this->settings->DB_USERNAME,
          $this->settings->DB_PASSWORD,
          $this->settings->DB_NAME
        );

        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function saveUser($username, $password) 
    {
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        mysqli_query($this->connection, $query);
    }

    public function doesUserExist($username) 
    {
        $row = $this->findUsers($username);

        if ($row['username'] === $username) {
            return true;
        } else {
            return false;
        }
    }

    public function findUsers($username)
    {
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->connection->prepare($query);

        $stmt->bind_param('s', $username);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row;
    }

    // public function validateUser($userCredentials)
    // {
    //     $query = 'SELECT * FROM users';

    //     // Get result
    //     $result = mysqli_query($this->connection, $query);

    //     // Fetch data
    //     $todos = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //     mysqli_free_result($result);
    //     mysqli_close($this->connection);

    //     return $todos;
    // }
}