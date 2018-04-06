<?php
class TelegramBot{
    private $token; //token per accedere al bot
    private $requestWebsite;
    
    /* costruttore 
    * @param $t token per accedere al bot
    */
    public function __construct($t){
        $this->token=$t;
        $this->requestWebsite="https://api.telegram.org/bot".$this->token."/";
    } //__construct
    
    /* eseguiMetodo
    * @param $m metodo da eseguire con eventuali parametri (i metodi ammessi sono indicati nelle API telegram)
    * @return oggetto json con il risultato del metodo
    */
    public function eseguiMetodo($m){
        return file_get_contents($this->requestWebsite.$m);
    } //eseguiMetodo
    
    /* metodo getUpdates
    * @return file json con gli update del bot
    */
    public function getUpdates(){
        return file_get_contents("php://input");
    } //getUpdates
    
    /* metodo sendMessage
    * @param $id id della chat dove inviare il messaggio
    * @param $text testo da inviare
    * @return file json con l'esito dell'invio 
    */
    public function sendMessage($id,$text){
        $text=urlencode($text);
        return $this->eseguiMetodo("sendMessage?text=$text&parse_mode=HTML&chat_id=$id");
    } //sendMessage
    
    /* metodo keyboard
    * @param $kb keyboard da fornire all'utente
    */
    public function keyboard($kb){ } //keyboard
} //TelegramBot


?>