<?php

$var = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/priviliged_user_model.php";
require_once($var);

class UserControllerBase
{
    protected $user;

    public function __construct()
    {
        if(isset($_SESSION["user"]))
        {
            $this->user = ($_SESSION["user"]);
        } 
        else 
        {
            $this->user = new PrivilegedUser($_POST["matricola"], $_POST["password"]);
        }
    }
    
    public function checkError()
    {
        $errors = $this->user->getErrorList();
        if(isempty($errors))
        {
            echo $errors;
        }
    }
}
