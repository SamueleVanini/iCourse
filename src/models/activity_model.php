<?php
$var = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/utils/db_utils.php";
require_once($var);

class activityModel {

    protected static $db;

    /** Costruttore di default */
    public function __construct()
    {
        self::$db = new Db();
    } //__construct

    /** metodo getActivityInformation
    * @param $activity_id id del corso di cui si vogliono visualizzare le informazioni
    * @return array associativo con le informazioni del corso
    */
    private function getActivityInformation($activity_id)
    {
        $conn = self::$db->getConnection();
        $stmt = $conn->prepare("select E.Nome as NomeCorso, E.Descrizione
                                from Eventi as E
                                where E.IdEvento=?");//ritorna le informazioni sull'evento avente id $activity_id
        $stmt->bind_param("i", $activity_id);
        $result = self::$db->runStatement($stmt);
        return $result->fetch_all(MYSQLI_ASSOC);
    } //getActivityInformation

    /** metodo getActivityImage
    * @param $activity_id id del corso di cui si vuole ottenere l'immagine di anteprima
    * @return immagine di anteprima del corso in base 64
    */
    private function getActivityImage($activity_id){
        $conn = self::$db->getConnection();
        $stmt = $conn->prepare("select E.ImmAnteprima
                                from Eventi as E
                                where E.IdEvento=?");//ritorna le informazioni sull'evento avente id $activity_id
        $stmt->bind_param("i", $activity_id);
        $result = self::$db->runStatement($stmt);
        $row=$result->fetch_assoc();
        return base64_encode($row["ImmAnteprima"]);
    } //getActivityImage

    /** metodo getActivityMoments
    * @param $activity_id id del corso di cui si vogliono visualizzare gli eventi
    * @return array associativo con gli eventi del corso
    */
    private function getActivityMoments($activity_id)
    {
        $conn = self::$db->getConnection();
        $stmt = $conn->prepare("select *
                                from MomentiEventi as ME
                                where ME.IdEvento=?");//ritorna le informazioni sull'evento avente id $activity_id
        $stmt->bind_param("i", $activity_id);
        $result = self::$db->runStatement($stmt);
        return $result->fetch_all(MYSQLI_ASSOC);
    } //getActivityInformation

    /** metodo getActivitySpec
    * @param $activity_id id del corso di cui si vogliono visualizzare gli eventi
    * @return array associativo con le specifiche del corso
    */
    private function getActivitySpec($activity_id)
    { 
        $conn = self::$db->getConnection();
        $stmt = $conn->prepare("select U.Nome, U.Cognome
                                from GestioneEventi as GE join Utenze as U on GE.IdInsegnante = U.IdUtente
                                where GE.IdEvento=?");//ritorna le informazioni sull'evento avente id $activity_id
        $stmt->bind_param("i", $activity_id);
        $result = self::$db->runStatement($stmt);
        return $result->fetch_all(MYSQLI_ASSOC);
    } //getActivitySpec

    /** metdo getActivityMaterials
    * @param $activity_id id del corso di cui si vogliono visualizzare i materiali
    * @return array associativo con i materiali del corso
    */
    public function getActivityMaterials($activity_id)
    {
        $conn = self::$db->getConnection();
        $stmt = $conn->prepare("SELECT M.NomeMateriale, M.DataAggiunta
                                FROM MaterialiEventi as ME JOIN Materiali as M ON ME.IdMateriale = M.IdMateriale
                                WHERE ME.IdEvento=?");//ritorna i materiali dell'evento avente id $activity_id
        $stmt->bind_param("i", $activity_id);
        $result = self::$db->runStatement($stmt);        
        return $result->fetch_all(MYSQLI_ASSOC);
    } //getActivityMaterials

    /** getActivityAllInformation
    * @param $activity_id id del corso di cui generare la pagina
    * @param $return_format formato dei dati ritornati dal metodo
    * @return array associativo o file json con i dati della activiy
    */
    public function getActivityAllInformation($activity_id, $return_format = null)
    {
        $activity_information=$this->getActivityInformation($activity_id);
        $activity_information[0]["ImmAnteprima"]=$this->getActivityImage($activity_id);
        $allInformations=array_merge($activity_information, array($this->getActivityMoments($activity_id)), array($this->getActivitySpec($activity_id)), array($this->getActivityMaterials($activity_id)));
        switch ($return_format) {
            case 1:
                return $allInformations;
            default:
                return json_encode($allInformations);
        } //switch
    } //getActivityAllInformation
} //activityModel
?>
