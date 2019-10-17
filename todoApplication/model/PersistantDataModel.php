<?php

namespace TodoModel;

use Exception;

class PersistantDataModel
{
    public function saveTodo($newTodo) 
    {
        $todos = $this->loadTodoFile();

        $newTodo = $newTodo->getTodo();

        if ($todos) {
            array_push($todos, $newTodo);
        } else {
            $todos = array ($newTodo);
        }

        $this->saveTodoFile($todos);
    }

    public function getTodosArray()
    {
        $file = (__DIR__ . '../../todos.json');

        if ($file) {
            $todos = json_decode(file_get_contents($file), true);
        }
        
        return $todos;
    }

    public function deleteTodoByName($todo)
    {
        $todos = $this->loadTodoFile();
        $todoToDelete = $todo;
        // var_dump($todoToDelete);

        // unset($todos[$todoToDelete]);

        // $this->saveTodoFile($todos);
        // foreach($todo as $todos)
        // {
        //     if ($todo == $todoToDelete)
        //     {
        //         $todos
        //     }
        // }

        // $data[0]['activity_name'] = "TENNIS";
        // // or if you want to change all entries with activity_code "1"
        // foreach ($data as $key => $entry) {
        //     if ($entry['activity_code'] == '1') {
        //         $data[$key]['activity_name'] = "TENNIS";
        //     }
        // }
            // $newJsonString = json_encode($data);
            // file_put_contents('jsonFile.json', $newJsonString);
    }

    public function loadTodoFile()
    {
        $file = (__DIR__ . '../../todos.json');
        if ($file) {
            $todos = json_decode(file_get_contents($file), true);
        }

        return $todos;
    }

    public function saveTodoFile(array $todos)
    {
        $file = (__DIR__ . '../../todos.json');
        $todos = $todos;
        
        $json = json_encode($todos);
        file_put_contents($file, $json);
        // fwrite($file, $todos);
    }

}