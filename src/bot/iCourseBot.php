<?php
require_once("TelegramBot.php");
require_once("../utils/db_utils.php");

class iCourseBot extends TelegramBot{
    private $db; //oggetto di classe database per accedere alle informazioni necessarie
    
    /* costruttore */
    public function __construct(){
        $this->db=new Db();
        parent::__construct($this->db->getBotToken());
    } //__construct
    
    /* metodo trovaComunicazione 
    * @return array associativo con le informazioni della comunicazione da inviare
    */
    public function trovaInviaComunicazione(){
        $comunicazioni=$this->db->runQuery("SELECT * FROM Comunicazioni as C JOIN Utenze as U ON C.IDUtente=U.IDUtente JOIN Eventi as E ON C.IdEvento=E.IdEvento WHERE C.HasToBeSent=TRUE AND E.CodTelegram IS NOT NULL");
        while($comunicazione=$comunicazioni->fetch_assoc()){
            $this->inviaComunicazione($comunicazione);
        } //while
        $comunicazioni->close();
    } //trovaComunicazione
    
    /* metodo inviaComunicazione 
    * @param $comunicazione comunicazione da inviare (array associativo con le informazioni della comunicazione)
    */
    public function inviaComunicazione($comunicazione){
        $text="Comunicazione da:".$comunicazione["Nome"]." ".$comunicazione["Cognome"]."\nData:".$comunicazione["Data"]." ".$comunicazione["Ora"]."\nTesto:".$comunicazione["Testo"];
        parent::sendMessage($comunicazione["CodTelegram"],$text);
    } //inviaComunicazione
    
    /* metodo registraGruppoTelegram
    * @param nG nome del gruppo telegram e anche del corso
    * @param idG id della chat del gruppo telegram
    * invia un messaggio sul gruppo indicando l'esito della registrazione
    */
    public function registraGruppoTelegram($nG, $idG){
        $res=$this->db->runQuery("SELECT * FROM Eventi as E WHERE E.Nome='$nG' AND E.CodTelegram IS NULL");
        if($res->num_rows==1){
            $this->db->runQuery("UPDATE `Eventi` SET `CodTelegram`=$idG WHERE Eventi.Nome='$nG' AND Eventi.CodTelegram IS NULL");
            parent::sendMessage($idG, "Gruppo Telegram registrato correttamente, eventuali nuove comunicazioni relative al corso associato a questo gruppo verranno inviate qui!");
        } else
            parent::sendMessage($idG, "Registrazione fallita: il gruppo telegram è già registrato o il corso non è registrato nel sistema");
    } //registraGruppoTelegram
    
    /* metodo prossimoEvento
    * @param $nG nome del gruppo 
    * @param $codT codice del gruppo telegram
    * invia nel gruppo il prossimo evento
    */
    public function prossimoEvento($nG,$codT){
        date_default_timezone_set('Europe/Rome');
        $res=$this->db->runQuery("SELECT * FROM Eventi AS E JOIN MomentiEventi AS ME ON E.IdEvento=ME.IdEvento WHERE E.Nome='$nG' AND ME.Data>'".date("Y-m-d")."'");
        if($res->num_rows==0)
            parent::sendMessage($codT,"Nessun evento programmato per il futuro per questo corso");
        else{
            $text="";
            while($row=$res->fetch_assoc())
               $text=$text."Il prossimo incontro si terrà in:".$row["Luogo"]." in data: ".$row["Data"]." dalle ore:".$row["OraInizio"]." alle ore:".$row["OraFine"];
        } //else
        parent::sendMessage($codT,$text);
    } //prossimoEvento
    
    /* metodo registraMessaggio
    * @param $user utente mittente
    * @param $message messaggio inviato
    * @param $gruppo gruppo telegram in cui è stato inviato il messaggio
    */
    public function registraMessaggio($user, $message, $gruppo){
        date_default_timezone_set('Europe/Rome');
        $res=$this->db->runQuery("INSERT INTO `MessaggiTelegram`(`NomeEvento`, `UtenteTelegram`, `TestoMessaggio`, `DataOra`) VALUES ('$gruppo','$user','$message','".date('Y-m-d H:i:s')."')");
    } //registraMessaggio
    
} //iCourseBot
?>
