<?php

namespace Modal;

class DataBaseModel {
    public function __construct()
    {
        
    }
    // JAWSDB SETUP
    public function dataBaseSetup() {
        throw new Exception('Not implemented yet');

        if($_SERVER['SERVER_NAME'] == 'localhost') {
            $hostname = 'localhost';
            $username = 'root';
            $password = '';
            $database = 'usercredentials';
        } else {
            $url = getenv('JAWSDB_URL');
            $dbparts = parse_url($url);
            
            $hostname = $dbparts['host'];
            $username = $dbparts['user'];
            $password = $dbparts['pass'];
            $database = ltrim($dbparts['path'],'/');
        }
    
        // Create connection
        $conn = new mysqli($hostname, $username, $password, $database);
    
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        // echo 'Connection was successfully established!';
    }
}