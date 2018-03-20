<?php
require_once("TelegramBot.php");
require_once("../utils/db_utils.php");

class iCourseBot extends TelegramBot{
    private $db; 
    private $id_channel;
    
    /* costruttore 
    * @param $i_c id del canale dove il bot invia le comunicazioni
    */
    function __construct($i_c){
        $this->db=new Db();
        parent::__construct($this->db->getBotToken());
        $this->id_channel=$this->db->getBotChannel();
    } //__construct
    
    /* metodo trovaComunicazione 
    * @return array associativo con le informazioni della comunicazione da inviare
    */
    function trovaInviaComunicazione(){
        $comunicazioni=$this->db->runQuery("SELECT * FROM Comunicazioni as C JOIN Utenze as U ON C.IDUtente=U.IDUtente WHERE C.HasToBeSent=TRUE");
        while($comunicazione=$comunicazioni->fetch_assoc()){
            $this->inviaComunicazione($comunicazione);
        } //while
        $comunicazioni->close();
    } //trovaComunicazione
    
    /* metodo inviaComunicazione 
    * @param $comunicazione comunicazione da inviare (array associativo con le informazioni della comunicazione
    */
    function inviaComunicazione($comunicazione){
        $text=urlencode("Comunicazione da:".$comunicazione["Nome"]." ".$comunicazione["Cognome"]."\nData:".$comunicazione["Data"]." ".$comunicazione["Ora"]."\nTesto:".$comunicazione["Testo"]);
        parent::eseguiMetodo("sendmessage?chat_id=$this->id_channel&text=$text");
    } //inviaComunicazione
} //iCourseBot

$bot=new iCourseBot("585143993:AAGoTXJB0nPXzEY0puvtSjwf3G4s48zj7_Q",-1001245132047);
$result=$bot->trovaInviaComunicazione();
?>