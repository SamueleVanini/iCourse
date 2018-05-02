<?php
    $var = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/utils/db_utils.php";
    require_once($var);

    class communicationModel {

        protected static $db;

        /** Costruttore di default */
        public function __construct()
        {
            self::$db = new Db();
        }

        /**
        * @param $user id dell'utente
        * @param $return_format indicazione del formato dei dati di output
        * @return file json o array associativo contenente le comunicazioni relative ai corsi dell'utente $user
        */
        public function getUserCommunications($user, $return_format = null)
        {
            $sql = "select e.Nome, c.Titolo
                    from Comunicazioni as c join Eventi as e on c.IdEvento = e.IdEvento
                    where c.IdEvento in (
                        select m.IdEvento
                        from MomentiEventi as m join Partecipanti as p on (m.IdMomento = p.IdMomento)
                        where p.IdPartecipante =". $user->getUserId().")
                    order by c.Data, c.Ora
                    limit 5"; //ritorna le ultime 5 comunicazioni più recenti per lo specifico user
            $result = self::$db->runQuery($sql);
            switch ($return_format) {
                case 1:
                    $result_array = $result->fetch_all(MYSQLI_ASSOC);
                    return $result_array;
                default:
                    $result_array = $result->fetch_all(MYSQLI_ASSOC);
                    return json_encode($result_array);
            } //switch
        } //getUserCommunication

        public function salvaComunicazione($idEv, $titolo, $testo, $file, $nomeFile) {
            $idAlleg = null;
            if ($file != null && $nomeFile != null) {
                $sql = "INSERT INTO Allegati (File, NomeAllegato) VALUES (".$file.", ".$nomeFile.");";
                self::$db->runQuery($sql);
                $idAlleg = self::$db->getConnection()->$insert_id;
            }
            $sql = "INSERT INTO Comunicazioni (IdEvento, Data, Ora, IdUtenteCreatore, Titolo, Testo, IdAllegato) VALUES (".$idEv.", ".date("Y-m-d").", ".date("H:m:s").", ".$user->getUserId().", ".$titolo.", ".$testo.", ".$idAlleg.");";
            self::$db->runQuery($sql);
        }

        public function getAllNomeEventiGestiti($user, $return_format = null) {
            $sql = "SELECT g.IdEvento, e.Nome FROM GestioneEventi as g join Eventi as e on (g.IdEvento = e.IdEvento) WHERE g.IdInsegnante = ".$user->getUserId().";";
            $this->db->runQuery($sql);
            switch ($return_format) {
                case 1:
                    $result_array = $result->fetch_all(MYSQLI_ASSOC);
                    return $result_array;
                default:
                    $result_array = $result->fetch_all(MYSQLI_ASSOC);
                    return json_encode($result_array);
            } //switch
        }

    } //communicationModel
?>
