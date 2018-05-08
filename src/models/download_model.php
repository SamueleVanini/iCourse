<?php
$var = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/utils/db_utils.php";
require_once($var);

class DownloadModel {

    protected static $db;

    /** Costruttore di default */
    public function __construct()
    {
        self::$db = new Db();
    } //__construct

    /** downloadAllegato
    * @param $idAllegato id dell'allegato che si vuole scaricare
    * @download file desiderato
    */
    public function downloadAllegato($idAllegato){
        $sql="SELECT a.File, a.NomeAllegato
              FROM Allegati as a
              WHERE a.IdAllegato = $idAllegato
             ";
        $result=self::$db->runQuery($sql);
        $row=$result->fetch_assoc();
        header("Content-Disposition: attachment; filename=".$row["NomeAllegato"]);
        ob_clean();
        flush();
        echo $row["File"];
    } //downloadAllegato

    /** downloadMateriale
    * @param $idMateriale id del materiale che si vuole scaricare
    * @download file desiderato
    */
    public function downloadMateriale($idMateriale){
        $sql="SELECT m.Materiale, m.NomeMateriale
              FROM Materiali as m
              WHERE m.IdMateriale = $idMateriale
             ";
        $result=self::$db->runQuery($sql);
        $row=$result->fetch_assoc();
        header("Content-Disposition: attachment; filename=".$row["NomeMateriale"]."");
        ob_clean();
        flush();
        echo $row["Materiale"];
    } //downloadAllegato
} //DownloadModel
?>
