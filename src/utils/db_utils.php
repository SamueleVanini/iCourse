<?php

class Db
{
    private $conn;
    public $error_list = array();

    public function __construct()
    {
        $this->conn = new mysqli("localhost", "root", "", "forum");
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
}