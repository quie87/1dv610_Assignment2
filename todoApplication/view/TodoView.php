<?php

namespace Todoview;

class TodoView {
    private static $todo = 'TodoView::todo';
    private static $submit = 'TodoView::submit';
    private static $messageId = 'TodoView::Message';

    private $message;

    /**
	 * Create HTTP response
	 *
	 * Should be called after an attempt to add new todo has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {
        $response = $this->generateAddTodoFormHTML($this->message);
        
		return $response;
	}

    private function generateAddTodoFormHTML($message) {
		return '
			<form method="get" > 
				<fieldset>
					<legend>Enter a new Todo</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$todo . '">Todo :</label>
					<input type="text" id="' . self::$todo . '" name="' . self::$todo . '" value="' .'" />
					
					<input type="submit" name="' . self::$submit . '" value="Add" />
				</fieldset>
			</form>
		';
    }
    
    public function doUserWantToAddNewTodo() : bool {
		if ($this->userClickedSubmit()) {
			$this->checkForEmptyFields();
		}
		
		if ($this->userClickedSubmit() && $this->hasNewTodo()) {
			return true;
		} else {
			return false;
		}
	}

	private function userClickedSubmit() {
		return isset($_GET[self::$submit]);
	}
	
	private function checkForEmptyFields () {
		if (!$this->hasNewTodo()) {
			$this->setMessage("Pls enter something Todo");
		} 
		return;
	}

	private function hasNewTodo () : bool {
		return isset($_GET[self::$todo]) && !empty($_GET[self::$todo]);
	}

	public function setMessage($message) {
		$this->message = $message;
	}
	
	public function getTodoItem () : \Todomodel\TodoModel {
		if ($this->hasNewTodo() ) {
			$todo = $this->getNewTodo();

			return new \Todomodel\TodoModel($todo);
		}
	}

	public function getNewTodo() {
		return ($_GET[self::$todo]);
	}
}