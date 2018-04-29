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
    * @param $activiy_id id del corso di cui si vogliono visualizzare le informazioni
    * @return array con le informazioni del corso
    */
    private function getActivityInformation($activity_id)
    {
        $sql = "select E.Nome as NomeCorso, E.Descrizione
                from Eventi as E
                where E.IdEvento=$activity_id
                "; //ritorna le informazioni sull'evento avente id $activity_id
        $result=self::$db->runQuery($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    } //getActivityInformation

    /** metodo getActivityImage
    * @param $activiy_id id del corso di cui si vuole ottenere l'immagine di anteprima
    * @return immagine di anteprima del corso in base 64
    */
    private function getActivityImage($activity_id){
        $sql = "select E.ImmAnteprima
                from Eventi as E
                where E.IdEvento=$activity_id
                "; //ritorna le informazioni sull'evento avente id $activity_id
        $result=self::$db->runQuery($sql);
        $row=$result->fetch_assoc();
        return base64_encode($row["ImmAnteprima"]);
    } //getActivityImage

    /** metodo getActivityMoments
    * @param $activiy_id id del corso di cui si vogliono visualizzare gli eventi
    * @return array con gli eventi del corso
    */
    private function getActivityMoments($activity_id)
    {
        $sql = "select *
                from MomentiEventi as ME
                where ME.IdEvento=$activity_id
                "; //ritorna gli eventi dell'evento avente id $activity_id
        $result=self::$db->runQuery($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    } //getActivityInformation

    /** metodo getActivitySpec
    * @param $activiy_id id del corso di cui si vogliono visualizzare gli eventi
    * @return array con le specifiche del corso
    */
    private function getActivitySpec($activity_id)
    {
        $sql = "select U.Nome, U.Cognome
                from GestioneEventi as GE join Utenze as U on GE.IdInsegnante = U.IdUtente
                where GE.IdEvento=$activity_id
                "; //ritorna i gestori dell'evento avente id $activity_id
        $result=self::$db->runQuery($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    } //getActivitySpec

    /** getActivityAllInformation
    * @param $activiy_id id del corso di cui generare la pagina
    * @param $return_format formato dei dati ritornati dal metodo
    * @return array associativo o file json con i dati della activiy
    */
    public function getActivityAllInformation($activity_id, $return_format = null)
    {
        $activity_information=$this->getActivityInformation($activity_id);
        $activity_information[0]["ImmAnteprima"]=$this->getActivityImage($activity_id);
        $allInformations=array_merge($activity_information, array($this->getActivityMoments($activity_id)), array($this->getActivitySpec($activity_id)));
        switch ($return_format) {
            case 1:
                return $allInformations;
            default:
                return json_encode($allInformations);
        } //switch
    } //getActivityAllInformation
} //activityModel
?>
