<?php

namespace TodoModel;

class PersistantDataModel
{
    public function saveTodo($newTodo) {
        $file = (__DIR__ . '/todos.json');
        $todos = json_decode(file_get_contents($file), true);

        $newTodo = $newTodo->getTodo();

        if ($todos) {
            array_push($todos, $newTodo);
        } else {
            $todos = array ($newTodo);
        }

        $json = json_encode($todos);
        file_put_contents($file, $json);

        
        // $json = json_decode(file_get_contents(__DIR__ . '/todos.json'));
        // $newJsonString = $json . " " . $newTodo->getTodo();

        // $file = fopen(__DIR__ . '/todos.json','w');
        // fwrite($file, json_encode($newJsonString, JSON_PRETTY_PRINT));
        // fclose($file);


        // $array = array('todo' => $todos, $newTodo);
        // $fp = fopen(__DIR__ . '/todos.json','w');
        // fwrite($fp, json_encode($array, JSON_PRETTY_PRINT));   //here it will print the array pretty
        // fclose($fp);
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