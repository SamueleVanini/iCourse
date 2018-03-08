<?php

include("../utils/db_utils.php");

class InformazioniCorsi
{
    private static $db;
    
    public static function initDb()
    {
        self::$db = new Db();
    }
    public function getAll()
    {
        $query = "SELECT * FROM corsi";
        $result = self::$db->runQuery($sql);
        if($result === false)
        {
            printf("Error query for course infmation: %s\n", $this->con->error);
        }
        /**
         * TODO Modificare in modo che ritorni i dati in formato json 
         */
        return $result;
    }
}

$info = new InformazioniCorsi();
$info->getAll();
