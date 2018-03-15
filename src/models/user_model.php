<?php

include_once("../utils/db_utils.php");

class User
{
    protected $user_id;
    protected $user_matricola;
    protected $username;
    protected static $db;
    private $course_list = [];
    private $class = [];

    /**
    * @param $username username dell'utente
    * @param $matricola matricola dell'utente
    * @param $password password dell'utente
    */
    public function __construct($username, $matricola, $password)
    {
        self::$db = new Db();
        $sql = "SELECT * FROM Utenze WHERE";
        if(isset($matricola))
            $sql+="username = '$username'";
        else
            $sql+="matricola = '$matricola'";
        $sql+="and password = '$password'";
        $result = self::$db->runQuery($sql);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        if(!empty($result))
        {
            
            $this->user_id = $result[0]["Id_Utente"];
            $this->user_matricola = $result[0]["Matricola"];
            $this->username = $username;
        }
        else
        {
            self::$db->error_list[] = "Login error, le tue credenziali non sono valide";
        } //if-else
    } //__construct
    
    /** 
    * @return lista degli errori per l'utente $this
    */
    public function getErrorList()
    {
        return self::$db->error_list;
    } //getErrorList

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