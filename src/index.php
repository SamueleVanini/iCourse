<?php

require_once("config.php");

class InformazioniCorsi extends Config
{
    private $con;
    
    public function __construct() 
    {
        parent::load();
        $this->con = new mysqli($this->DB_HOST, $this->DB_USERNAME, $this->DB_PASSWD, $this->DB_NAME);
        echo "";
        if($this->con->connect_error)
        {
            die("Connect Error: ".  $this->con->connect_error);
        }
    }
    
    public function getInformazioni()
    {
        $query = "SELECT ? FROM ?";
        $result = $this->con->query($query);
        if($result === false)
        {
            printf("Error query for course infmation: %s\n", $this->con->error);
        }
        $this->con->close();
        return $result;
    }
}

$info = new InformazioniCorsi();
$info->getInformazioni();

