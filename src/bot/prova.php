<?php
require_once("iCourseBot.php");
$bot=new iCourseBot();

$update=json_decode($bot->getUpdates(), true);

$text = $update["message"]["text"];
$title = $update["message"]["chat"]["title"];
$cid = $update["message"]["chat"]["id"];
$user=$update["message"]["from"]["first_name"];

if(isset($update["message"]["document"]["file_id"])){
    $idFile=$update["message"]["document"]["file_id"];
    $fileName=$update["message"]["document"]["file_name"];
} //if allegato standard
if(isset($update["message"]["voice"]["file_id"])){
    $idFile=$update["message"]["voice"]["file_id"];
    $fileName="File audio";
} //if allegato vocale
if(isset($update["message"]["photo"][0]["file_id"])){
    $idFile=$update["message"]["photo"][0]["file_id"];
    $fileName="File immmagine";
} //if allegato foto
if(isset($update["message"]["video_note"]["file_id"])){
    $idFile=$update["message"]["video_note"]["file_id"];
    $fileName="File video-nota";
} //if allegato video_nota
if(isset($update["message"]["video"]["file_id"])){
    $idFile=$update["message"]["video"]["file_id"];
    $fileName="File video";
} //if allegato video

if($text=="/start" || $text=="/start@iCourseBot")
    $bot->sendMessage($cid, "Benvenuto sul bot telegram di iCourse, il sistema di gestione dei corsi pomeridiani dell'ITI F.Severi!\nPer la lista dei comandi digitare /help");

if($text=="/help" || $text=="/help@iCourseBot")
    $bot->sendMessage($cid,"/start per avviare il bot\n/registra per registrare il gruppo telegram, il comando va lanciato all'interno di un gruppo\n/prossimoEvento per visulizzare il prossimo evento in programma per quel determinato corso");

if($text=="/registra" || $text=="/registra@iCourseBot")
    $bot->registraGruppoTelegram($title,$cid);

if($text=="/prossimoEvento" || $text=="/prossimoEvento@iCourseBot")
    $bot->prossimoEvento($title,$cid);

if(isset($title))
    $bot->registraMessaggio($user,$text,$title,$idFile, $fileName);



?>
