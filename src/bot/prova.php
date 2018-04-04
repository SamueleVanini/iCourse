<?php
    require_once("iCourseBot.php");
    $bot=new iCourseBot();

    $update=json_decode($bot->getUpdates(), true);

    $text = $update["message"]["text"];
    $title = $update["message"]["chat"]["title"];
    $cid = $update["message"]["chat"]["id"];

    if($text=="/start" || $text=="/start@iCourseBot"){
        $bot->sendMessage($cid, "Benvenuto sul bot telegram di iCourse, il sistema di gestione dei corsi pomeridiani dell'ITI F.Severi!\nPer la lista dei comandi digitare /help");
    } //if

    if($text=="/registra" || $text=="/registra@iCourseBot"){
        if($bot->registraGruppoTelegram($title,$cid))
            $bot->sendMessage($cid, "Gruppo Telegram registrato correttamente, eventuali nuove comunicazioni relative al corso associato a questo gruppo verranno inviate qui!");
        else
            $bot->sendMessage($cid, "Registrazione fallita: il gruppo telegram è già registrato o il corso non è registrato nel sistema");
    } //if

    if($text=="/help" || $text=="/help@iCourseBot"){
        $bot->sendMessage($cid,"/start per avviare il bot\n/registra per registrare il gruppo telegram, il comando va lanciato all'interno di un gruppo");
    } //if
?>
