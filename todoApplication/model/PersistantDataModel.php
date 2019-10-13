<?php

namespace TodoModel;

class PersistantDataModel
{
    public function saveTodo($newTodo) {
        $json = file_get_contents(__DIR__ . '/todos.json');

        $json .= $newTodo->getTodo() . ', '; 
        $file = fopen(__DIR__ . '/todos.json','w');
        fwrite($file, $json);
        fclose($file);


    }
}