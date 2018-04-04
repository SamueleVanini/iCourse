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
            $text="Comunicazione da:".$comunicazione["Nome"]." ".$comunicazione["Cognome"]."\nData:".$comunicazione["Data"]." ".$comunicazione["Ora"]."\nTesto:".$comunicazione["Testo"];
            parent::sendMessage($comunicazione["CodTelegram"],$text);
        } //inviaComunicazione

        /* metodo registraGruppoTelegram
        * @param nG nome del gruppo telegram e anche del corso
        * @param idG id della chat del gruppo telegram
        * @return true se la registrazione è avvenuta con successo, false se la registrazione è fallita: il gruppo è già registrato o il corso non è registrato nel sistema
        */
        function registraGruppoTelegram($nG, $idG){
            $res=$this->db->runQuery("SELECT * FROM Eventi as E WHERE E.Nome='$nG' AND E.CodTelegram IS NULL");
            if($res->num_rows==1){
                $this->db->runQuery("UPDATE `Eventi` SET `CodTelegram`=$idG WHERE Eventi.Nome='$nG' AND Eventi.CodTelegram IS NULL");
                return true;
            } //if
            return false;
        } //registraGruppoTelegram

        /* metodo prossimoEvento
         * @param $nG nome del gruppo
         * @param $codT codice del gruppo telegram
         * invia nel gruppo il prossimo evento
        */
        function prossimoEvento($nG,$codT){
            $res=$this->db->runQuery("SELECT * FROM Eventi AS E JOIN MomentiEventi AS ME ON E.IdEvento=ME.IdEvento WHERE E.Nome='$nG' AND ME.Data>'".date("Y-m-d")."'");
            if($res->num_rows=0)
                parent::sendMessage($codT,"Nessun evento programmato per il futuro per questo corso");
            else{
                $text="";
                while($row=$res->fetch_assoc())
                   $text+="Il prossimo incontro si terrà in:".$row["Luogo"]." in data: ".$row["Data"]." dalle ore:".$row["OraInizio"]." alle ore:".$row["OraFine"])."\n";
                parent::sendMessage($codT,$text);
            } //else

        } //prossimoEvento
    } //iCourseBot
?>
