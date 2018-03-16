<?php

$var = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/utils/db_utils.php";
require_once($var);

class InformazioniCorsi
{
    private static $db;
    
    public static function initDb()
    {
        self::$db = new Db();
    }
    public function getAll()
    {
        $query = "SELECT * FROM Eventi";
        $result = self::$db->runQuery($query);
        if($result === false)
        {
            printf("Error query for course infmation: %s\n", $this->conn->error);
        }
        $result_array = $result->fetch_all(MYSQLI_ASSOC);
        return json_encode($result_array);
    }
}

$info = new InformazioniCorsi();
$info->initDb();
echo $info->getAll();
