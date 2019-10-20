<?php

namespace Todoview;

class TodoView 
{
    private $authController;

    private static $todo = 'TodoView::todo';
    // private static $todoID = 'TodoView::todoID';
    private static $add = 'TodoView::add';
    private static $delete = 'TodoView::delete';
    private static $messageId = 'TodoView::Message';

    private $message;
    private $todos;

    public function __construct($authController)
    {
        $this->authController = $authController;
        $this->todos = new \TodoModel\Todos();
    }

    public function doUserWantToAddNewTodo() : bool 
    {
		if ($this->userClickedAddTodo()) {
			$this->checkForEmptyFields();
		}
		
        if ($this->userClickedAddTodo() && $this->hasNewTodo()) {
			return true;
		} else {
			return false;
		}
	}

    private function userClickedAddTodo() 
    {
		return isset($_GET[self::$add]);
    }
    
    private function checkForEmptyFields () 
    {
        if (!$this->hasNewTodo()) {
            $this->setMessage("Pls enter something Todo");
        } 
        return;
    }

    public function doUserWantToDeleteTodo()
    {
        return isset($_GET[self::$delete]);
    }

    public function getTodoToDelete()
    {
        //TODO: Should return a Todo with name and ID

        // print_r($_POST);

        // $todos = $this->todos->getTodosArray();
        
        // $stringToReturn = '';

        // foreach($todos as  $todo)
        //     if... $_POST[__class__ .":delete:" . $todo->getUnique() ]


        // var_dump($_GET['id']);
        // print_r($_GET);
        // return isset($_GET[self::$todo]);
        
    } 
	

    private function hasNewTodo () : bool 
    {
		return isset($_GET[self::$todo]) && !empty($_GET[self::$todo]);
	}

	
    public function getTodoItem () : \Todomodel\Todo
    {
        if ($this->hasNewTodo() ) {
            $todo = $this->getNewTodo();
            
			return new \Todomodel\Todo($this->authController->getLoggedInUserName(), $todo);
		}
	}
    
    public function getNewTodo() 
    {
        return ($_GET[self::$todo]);
    }
    
    public function setMessage($message) 
    {
        $this->message = $message;
    }

    /**
	 * Create HTTP response
	 *
	 * Should be called after an attempt to add new todo has been determined
	 *
	 * @return  void BUT writes to standard output
	 */
    public function response() 
    {
        $response = $this->generateAddTodoFormHTML($this->message);
        $response .= $this->generateListOfTodosHTML();
        
		return $response;
	}

    private function generateAddTodoFormHTML($message) 
    {
		return '
			<form method="GET" > 
				<fieldset>
					<legend>Enter a new Todo</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$todo . '">Todo :</label>
					<input type="text" id="' . self::$todo . '" name="' . self::$todo . '" value="' .'" />
					
					<input type="submit" name="' . self::$add . '" value="Add" />
				</fieldset>
			</form>
		';
    }

    private function generateListOfTodosHTML() 
    {
        return '
            <h2>Current Todos</h2>
            <form method="GET">
            </form>
            ';
            // <ul>' . $this->getTodoList() . '</ul>
    }

    private function getTodoList()
    {
        $todos = $this->todos->getTodos();
        
        if (empty($todos))
        {
            return '';
        }
        $stringToReturn = '';

        // foreach($todos as $key => $todo)
        foreach($todos as $todo)
        {
            $stringToReturn .= "<form method='GET'>";
            $stringToReturn .= "<li>";
            $stringToReturn .= $todo;
            $stringToReturn .= "<input type='submit' name='";
            $stringToReturn .= self::$delete;
            $stringToReturn .= "' value='Delete' ";
            $stringToReturn .= "className='remove-btn' />";
            
            // $stringToReturn .= "<input type='hidden' name='";
            // $stringToReturn .= __class__ .":delete:" . $key;
            // $stringToReturn .= "' />";
            // $stringToReturn .= "</li>";
            // $stringToReturn .= "</form>";
        }

        return $stringToReturn;
    }


}