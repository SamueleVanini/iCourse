<?php
    $var = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/priviliged_user_model.php";
    $path2 = $_SERVER['DOCUMENT_ROOT']."/iCourse/template/index.php";
    $path3 = $_SERVER['DOCUMENT_ROOT']."/iCourse/template/home.php";
    $path4 = $_SERVER['DOCUMENT_ROOT']."/iCourse/template/personal_data.php";
    require_once($var);

    class UserControllerBase
    {
        protected $user;

        public function __construct()
        {
            if(isset($_POST["matricola"]) && isset($_POST["password"]))
            {
                $this->user = new PrivilegedUser($_POST["matricola"], hash("sha256", $_POST["password"]));
                if(!($this->user->getUserId() === null))
                {
                    $_SESSION["logged"] = true;
                    $a = serialize($this->user);
                    $_SESSION["user"] = $a;
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
        header("Refresh: 3; url = /iCourse/template", true, 301);
    }
    elseif(!$user->getUser()->hasPrivilege(13))
    {

        header("Refresh: 3; url = /iCourse/template", true, 301);
        echo "Non hai i privilegi per accedere a questa pagina, redirect in 3 secondi...";
        exit;
    }
    else
    {
        header("Location: /iCourse/template/home.php");
        //exit;
    }
?>
