<?php

namespace Todoview;

class LayoutView 
{
    public function render($view) 
    {
        echo '<!DOCTYPE html>
          <html>
            <head>
              <meta charset="utf-8">
              <title>Todo Application</title>
            </head>
            <body>
              <h1>Todo</h1>
              
              <div class="container">
              ' . $view->response() . '
              </div>
             </body>
          </html>
        ';
    }
}