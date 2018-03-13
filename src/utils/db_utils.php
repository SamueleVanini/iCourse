<?php

require_once("../config.php");

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
    }

    /**
     * @param $sql query da eseguire
     * @return mysqli_resul risultato della query
     */
    public function runQuery($sql)
    {
        return $this->conn->query($sql);
    }

    /** Chiude la connessione */
    public function closeConnection()
    {
        $this->conn->close();
    }
}