<?php

namespace TodoModel;

class PersistantDataModel
{
    public function saveTodo($newTodo) 
    {
        $todos = $this->loadTodoFile();
        $todoObject = array (
            $newTodo->getUserName(),
            $newTodo->getTodoName()
        );

        // $newTodo = $newTodo->getTodoName();

        if ($todos) {
            array_push($todos, $todoObject);
        } else {
            $todos[] = $todoObject;
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

        $json = json_encode($todos);
        file_put_contents($file, $json);
        // fwrite($file, $todos);
    }

}