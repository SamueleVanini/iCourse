<?php

include_once("../utils/db_utils.php");

class User
{
    protected $user_id;
    protected $username;
    protected $password;
    protected static $db;
    private $course_list = [];
    private $class = [];


    public function __construct($username, $password)
    {
        self::$db = new Db();
        $sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
        $result = self::$db->runQuery($sql);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        if(!empty($result))
        {
            
            $this->user_id = $result[0]["user_id"];
            $this->username = $username;
            $this->password = $password;
        }
        else
        {
            self::$db->error_list[] = "Login error, le tue credenziali non sono valide";
        }
    }
    
    public function getErrorList()
    {
        return self::$db->error_list;
    }

    /**
     * Recupera la lista dei corsi di un utente
     */
    public function get_course_list() {}

    /**
     * Rcupera la lista delle classi a cui si appartiene (1 se studente, 1+ se professore)
     */
    public function get_class() {}

    /**
     * Setta la lista dei corsi di un utente
     */
    public function add_course() {}

    /**
     * Setta la lista dei corsi di un utente
     */
    public function remove_course() {}

    /**
     * Setta la lista delle classi a cui si appartiene (1 se studente, 1+ se professore)
     */
    public function add_class() {}

    /**
     * Setta la lista delle classi a cui si appartiene (1 se studente, 1+ se professore)
     */
    public function remove_class() {}
}