<?php

$var = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/priviliged_user_model.php";
$path2 = $_SERVER['DOCUMENT_ROOT']."/iCourse/template/student_home.php";
$path3 = $_SERVER['DOCUMENT_ROOT']."/iCourse/template/index.html";
require_once($var);

class UserControllerBase
{
    protected $user;

    public function __construct()
    {
        unset($_SESSION["user"]);
        if(isset($_SESSION["user"]))
        {
            $this->user = unserialize($_SESSION["user"]);
        } 
        else 
        {
            if(isset($_POST["matricola"]) && isset($_POST["password"]))
            {
                $this->user = new PrivilegedUser($_POST["matricola"], $_POST["password"]);
                if(!($this->user->getUserId() === null))
                {
                    $_SESSION["logged"] = true;
                    $a = serialize($this->user);
                    $_SESSION["user"] = $a;
                }
            }
        }
    }
    
    public function getUser()
    {
        return $this->user;
    }

    public function checkError()
    {
        $errors = $this->user->getErrorList();
        if($errors != NULL)
        {
            foreach($errors as $error)
            {
                echo $error;
            }
            return true;
        }
        return false;
    }

}

$user = new UserControllerBase();

if($user->checkError())
{
    header("Refresh: 3; url = http://localhost/iCourse/template/index.html", true, 301);
}
elseif(!$user->getUser()->hasPrivilege(13))
{
    
    header("Refresh: 3; url = http://localhost/iCourse/template/index.html", true, 301);
    echo "Non hai i privilegi per accedere a questa pagina, redirect in 3 secondi...";
    exit;
}
else
{
    header("Location: http://localhost/iCourse/template/student_home.php");
    //exit;
}
?>