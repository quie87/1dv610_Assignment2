<?php

require_once('view/LayoutView.php');
require_once('view/TodoView.php');

class TodoApp {
    private $layoutView;
    private $todoView;

    public function __construct()
    {
        $this->layoutView = new \Todoview\LayoutView();
        $this->todoView = new \TodoView\TodoView();
    }

    public function run() {
        $this->changeState();
        $this->generateOutput();
    }

    private function changeState() {

    }

    private function generateOutput() {
        $this->layoutView->render($this->todoView);
    }
}