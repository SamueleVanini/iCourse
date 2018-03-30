<?php

$var = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/config.php";
require_once($var);

class Db extends Config
{
    protected $conn;
    public $error_list = array();

    /** Costruttore, crea la connessione al database */
    public function __construct()
    {
        parent::load();
        $this->conn = new mysqli($this->DB_HOST, $this->DB_USERNAME, $this->DB_PASSWD, $this->DB_NAME);
        if($this->conn->connect_error)
            die("Connessione fallita: " . $this->conn->connect_error);
    } //__construct

    /**
     * @param $sql query da eseguire
     * @return mysqli_resul risultato della query in caso di successo altrimenti interrompe l'esecuzione dello script
     */
    public function runQuery($sql)
    {
        $result=$this->conn->query($sql);
        if($result === null || $result === false)
            return false;
        else
            return $result;
    } //runQuery

    /** Chiude la connessione */
    public function closeConnection()
    {
        $this->conn->close();
    } //closeConnection
    
} //Db
?>