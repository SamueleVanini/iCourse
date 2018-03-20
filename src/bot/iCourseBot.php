<?php
require_once("TelegramBot.php");
require_once("../utils/db_utils.php");

class iCourseBot extends TelegramBot{
    private $db; //oggetto di classe database per accedere alle informazioni necessarie
    
    /* costruttore */
    function __construct(){
        $this->db=new Db();
        parent::__construct($this->db->getBotToken());
    } //__construct
    
    /* metodo trovaComunicazione 
    * @return array associativo con le informazioni della comunicazione da inviare
    */
    function trovaInviaComunicazione(){
        $comunicazioni=$this->db->runQuery("SELECT * FROM Comunicazioni as C JOIN Utenze as U ON C.IDUtente=U.IDUtente JOIN Eventi as E ON C.IdEvento=E.IdEvento WHERE C.HasToBeSent=TRUE AND E.CodTelegram IS NOT NULL");
        while($comunicazione=$comunicazioni->fetch_assoc()){
            $this->inviaComunicazione($comunicazione);
        } //while
        $comunicazioni->close();
    } //trovaComunicazione
    
    /* metodo inviaComunicazione 
    * @param $comunicazione comunicazione da inviare (array associativo con le informazioni della comunicazione)
    */
    function inviaComunicazione($comunicazione){
        $text=urlencode("Comunicazione da:".$comunicazione["Nome"]." ".$comunicazione["Cognome"]."\nData:".$comunicazione["Data"]." ".$comunicazione["Ora"]."\nTesto:".$comunicazione["Testo"]);
        parent::eseguiMetodo("sendmessage?chat_id=".$comunicazione["CodTelegram"]."&text=$text");
    } //inviaComunicazione
} //iCourseBot

//$bot=new iCourseBot("585143993:AAGoTXJB0nPXzEY0puvtSjwf3G4s48zj7_Q",-1001245132047);
$bot=new iCourseBot();
$result=$bot->trovaInviaComunicazione();
?>