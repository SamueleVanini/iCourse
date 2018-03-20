<?php
class TelegramBot{
    private $token; //token per accedere al bot
    private $requestWebsite;
    
    /* costruttore 
    * @param $t token per accedere al bot
    */
    function __construct($t){
        $this->token=$t;
        $this->requestWebsite="https://api.telegram.org/bot".$this->token;
    } //__construct
    
    /* eseguiMetodo
    * @param $m metodo da eseguire con eventuali parametri (i metodi ammessi sono indicati nelle API telegram)
    * @return oggetto json con il risultato del metodo
    */
    function eseguiMetodo($m){
        return file_get_contents($this->requestWebsite."/$m");
    } //eseguiMetodo
} //TelegramBot


?>