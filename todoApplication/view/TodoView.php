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
		// if(!$isLoggedin) {
		// 	$response = $this->generateLoginFormHTML($this->message);
		// } else {
		// 	$response = $this->generateLogoutButtonHTML($this->message);
		// }
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
}