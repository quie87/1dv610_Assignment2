<?php

class LayoutView {  
  public function render($isLoggedIn, $view, DateTimeView $dtv) {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Application</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this->renderLinks($isLoggedIn) . '
          ' . $this->renderIsLoggedIn($isLoggedIn) . '
          
          <div class="container">
              ' . $view->response($isLoggedIn) . '
              
              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }
  
  private function renderIsLoggedIn($isLoggedIn) {
    if ($isLoggedIn) {
      return '<h2>Logged in</h2>';
    }
    else {
      return '<h2>Not logged in</h2>';
    }
  }

  public function userNavigatesToRegister() : bool {
		if (isset($_GET['register'])) {
			return true;
		} else {
			return false;
		}
  }
  
  private function renderLinks($isLoggedIn) {
    $ret = '';

    if(!$isLoggedIn && !$this->userNavigatesToRegister()) {
      $ret = '<a href="?register">Register a new user</a>';
    } else if (!$isLoggedIn && $this->userNavigatesToRegister()){ 
      $ret = '<a href="./">Back to login</a>';
    }
    return $ret;
  }
}
