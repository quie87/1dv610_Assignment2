<?php

namespace TodoModel;

use Exception;

class PersistantDataModel
{
    public function saveTodo($newTodo) {
        $file = (__DIR__ . '../../todos.json');

        if ($file) {
            $todos = json_decode(file_get_contents($file), true);
        }

        $newTodo = $newTodo->getTodo();

        if ($todos) {
            array_push($todos, $newTodo);
        } else {
            $todos = array ($newTodo);
        }

        $json = json_encode($todos);
        file_put_contents($file, $json);
    }

    public function getTodosArray()
    {
        $file = (__DIR__ . '../../todos.json');

        if ($file) {
            $todos = json_decode(file_get_contents($file), true);
        }

        return $todos;
    }

    // public function deleteTodo($todo)
    // {
    //     $jsonString = file_get_contents('jsonFile.json');
    //     $data = json_decode($jsonString, true);
        
    //     $data[0]['activity_name'] = "TENNIS";
    //     // or if you want to change all entries with activity_code "1"
    //     foreach ($data as $key => $entry) {
    //         if ($entry['activity_code'] == '1') {
    //             $data[$key]['activity_name'] = "TENNIS";
    //         }
    //     }
    //     $newJsonString = json_encode($data);
    //     file_put_contents('jsonFile.json', $newJsonString);
    // }
}