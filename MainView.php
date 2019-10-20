<?php

class MainView {
    public function render($isLoggedIn, $view) {
        echo '<!DOCTYPE html>
          <html>
            <head>
              <meta charset="utf-8">
              <title>Todo Application</title>
            </head>
            <body>
              <div class="container">
              ' . $view->response($isLoggedIn) . '
              </div>
            </body>
          </html>
        ';
    }
}