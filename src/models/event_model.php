<?php
    $var = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/utils/db_utils.php";
    require_once($var);

    class EventModel {

        protected static $db;

        /** Costruttore di default */
        public function __construct()
        {
            self::$db = new Db();
        }

        /**
         * @param return_format indica il formato i cui si vuole che i valori siano ritornati:
         * 1 -> array associativo semplice (dizionario);
         * non indicato/default -> array associativo formattato in json, le immagini sono in base64;
         * @return result risultato della query
        */
        public function getAll($return_format = null)
        {
            $a = array();
            $sql = "SELECT * FROM Eventi";
            $result = self::$db->runQuery($sql);
            switch ($return_format) {
                case 1:
                    $result_array = $result->fetch_all(MYSQLI_ASSOC);
                    foreach($result_array as $course)
                    {
                        $image = base64_encode($course["ImmAnteprima"]);
                        $course["ImmAnteprima"] = $image;
                        array_push($a,$course);
                    }
                    return $a;
                default:
                    $result_array = $result->fetch_all(MYSQLI_ASSOC);
                    foreach($result_array as $course)
                    {
                        $image = base64_encode($course["ImmAnteprima"]);
                        $course["ImmAnteprima"] = $image;
                        array_push($a,$course);
                    }
                    return json_encode($a);
            }
        }

        /**
         * @param return_format indica il formato i cui si vuole che i valori siano ritornati:
         * 1 -> array associativo semplice (dizionario);
         * non indicato/default -> array associativo formattato in json;
         * @param user utente per cui si vuole effettuare la ricerca
         * @return result risultato della query
        */
        public function searchUserEvents($user, $return_format = null)
        {
            $sql = "SELECT e.IdEvento, me.Data, me.OraInizio, e.Nome, me.OraFine
                    FROM Partecipanti as p join MomentiEventi as me on p.IdMomento = me.IdMomento join Eventi as e on me.IdEvento = e.IdEvento
                    WHERE p.IdPartecipante = ".$user->getUserId();
            $result = self::$db->runQuery($sql);
            switch ($return_format) {
                case 1:
                    $result_array = $result->fetch_all(MYSQLI_ASSOC);
                    return $result_array;
                default:
                    $result_array = $result->fetch_all(MYSQLI_ASSOC);
                    return json_encode($result_array);
            }
        }

        /**
         * @param return_format indica il formato i cui si vuole che i valori siano ritornati:
         * 1 -> array associativo semplice (dizionario);
         * non indicato/default -> array associativo formattato in json;
         * @param user utente per cui si vuole effettuare la ricerca
         * @return result risultato della query
        */
        public function searchUserPassword($user, $return_format = null)
        {
            $sql = "SELECT *
                      FROM Utenze as u
                      WHERE u.IdUtente = ".$user->getUserId();
            $result = self::$db->runQuery($sql);
            switch ($return_format) {
                case 1:
                    $result_array = $result->fetch_all(MYSQLI_ASSOC);
                    return $result_array;
                default:
                    $result_array = $result->fetch_all(MYSQLI_ASSOC);
                    return json_encode($result_array);
            }
        }

        /** Metodo per l'iserimento di un evento nel db
         * @param user utente che effettua l'inserimento
         * @param nome nome dell'evento
         * @param descrizione descrizione dell'evento
         * @param inizioEvento data di inizio dell'evento
         * @param scartoFineEvento scarto tra data di fine e di inizio di un evento continuo in più giorni
         * @param luogo luogo in cui si svolge l'evento
         * @param oraInizio ora di inizio dell'evento
         * @param oraFine ora di fine dell'evento
         * @param ripetizione flag che indica ogni quanto un evento deve ripetersi {0: mai, 1: ogni settimana, 2: ogni 2 settimane, 3: ogni mese}
         * @param fineRipetizione data in cui il numero di ripetizioni finiscono
         * @return true/false indica se l'inserimento è andato a buon fine
         */
        public function insertEvent($user, $nome, $descrizione, $inizioEvento, $scartoFineEvento, $luogo, $oraInizio, $oraFine, $ripetizione = null, $fineRipetizione = null)
        {
            $conn = self::$db->getConnection();
            $conn->autocommit(false);
            //Inserimento evento nella tabella "Eventi"
            $stmt = $conn->prepare("INSERT INTO Eventi (Descrizione, Nome) VALUES(?, ?)");
            $stmt->bind_param("ss", $descrizione, $nome);
            if(!$stmt->execute())
                $failure = true;
            //Estrazione id evento appena inserito
            $idEvento = $stmt->insert_id;
            $userId = $user->getUserId();

            //Inserimento id insegnante che tiene l'evento con evento nella tabella "GestioneEventi"
            $sql = "INSERT INTO GestioneEventi (IdEvento, IdInsegnante)
                    VALUES(".$idEvento.",".$userId.")";
            if(!$conn->query($sql))
            {
                //$stmt->close();
                return false;
            }
                else
                {
                    //$stmt->close();
                    if($this->momentiEventi($conn, $idEvento, $inizioEvento, $scartoFineEvento, $luogo, $oraInizio, $oraFine, $ripetizione, $fineRipetizione))
                    {
                        $conn->commit();
                        $conn->autocommit(true);
                        return true;
                    }
                    else
                    {
                        $conn->rollback();
                        return false;
                    }
                }
        }

        /** Metodo per indicare ogni quanto un evento va ripetuto in base alla ripetizione dell'evento
         * @param idEvento id dell'evento
         * @param inizioEvento data di inizio dell'evento
         * @param scartoFineEvento scarto tra data di fine e di inizio di un evento continuo in più giorni
         * @param luogo luogo in cui si svolge l'evento
         * @param oraInizio ora di inizio dell'evento
         * @param oraFine ora di fine dell'evento
         * @param ripetizione flag che indica ogni quanto un evento deve ripetersi {0: mai, 1: ogni settimana, 2: ogni 2 settimane, 3: ogni mese}
         * @param fineRipetizione data in cui il numero di ripetizioni finiscono
         */
        private function momentiEventi($conn, $idEvento, $inizioEvento, $scartoFineEvento, $luogo, $oraInizio, $oraFine, $ripetizione, $fineRipetizione)
        {
            if($this->checkInizioFineEvento($conn, $idEvento, $inizioEvento, $scartoFineEvento, $luogo, $oraInizio, $oraFine))
            {
                switch($ripetizione)
                {
                    case 1:
                        if($this->inserimentoMomentiEventiSettimanale($conn, $idEvento, $inizioEvento, $scartoFineEvento, $luogo, $oraInizio, $oraFine, $ripetizione = 7, $fineRipetizione) != false)
                            return true;
                        else
                            return false;
                    case 2:
                        if($this->inserimentoMomentiEventiSettimanale($conn, $idEvento, $inizioEvento, $scartoFineEvento, $luogo, $oraInizio, $oraFine, $ripetizione = 14, $fineRipetizione) != false)
                            return true;
                        else
                            return false;
                    case 3:
                        if($this->inserimentoMomentiEventiMensile($conn, $idEvento, $inizioEvento, $scartoFineEvento, $luogo, $oraInizio, $oraFine, $ripetizione = 1, $fineRipetizione) != false)
                            return true;
                        else
                            return false;
                    default:
                        return true;
                }
            }
            else
                return false;
        }

        /** Metodo per il controllo se un evento è contiguo in più giorni e l'inserimento in "MomentiEventi"
         * @param idEvento id dell'evento
         * @param inizioEvento data di inizio dell'evento
         * @param scartoFineEvento scarto tra data di fine e di inizio di un evento continuo in più giorni
         * @param luogo luogo in cui si svolge l'evento
         * @param oraInizio ora di inizio dell'evento
         * @param oraFine ora di fine dell'evento
         */
        private function checkInizioFineEvento($conn, $idEvento, $inizioEvento, $scartoFineEvento, $luogo, $oraInizio, $oraFine)
        {
            if(!is_string($inizioEvento))
            {
                $inizio = $inizioEvento->format('Y-m-d');
            }
            else
                $inizio = $inizioEvento;

            if($scartoFineEvento->days == 0)
            {
                $sql = "INSERT INTO MomentiEventi (IdEvento, Luogo, Data, OraInizio, OraFine)
                        VALUES(".$idEvento.",'".$luogo."','".$inizio."','".$oraInizio."','".$oraFine."')";
                $a = $conn->query($sql);
                if(!$a)
                    return false;
                return true;
            }
            else
            {
                $sql = "INSERT INTO MomentiEventi (IdEvento, Luogo, Data, OraInizio)
                        VALUES(".$idEvento.",'".$luogo."','".$inizio."','".$oraInizio."')";
                if(!$conn->query($sql))
                    return false;

                $fineEvento = date('Y-m-d', strtotime($inizio. " + $scartoFineEvento->days days"));

                $sql = "INSERT INTO MomentiEventi (IdEvento, Luogo, Data, OraFine)
                        VALUES(".$idEvento.",'".$luogo."','".$fineEvento->format('Y-m-d')."','".$oraFine."')";
                if(!$conn->query($sql))
                    return false;
                return true;
            }
        }

        /** Metodo per l'iserimento di un evento con cadenza ogni 1/2 settimane nella tabella "MomentiEventi" in base alla ripetizione dell'evento
         * @param idEvento id dell'evento
         * @param inizioEvento data di inizio dell'evento
         * @param scartoFineEvento scarto tra data di fine e di inizio di un evento continuo in più giorni
         * @param luogo luogo in cui si svolge l'evento
         * @param oraInizio ora di inizio dell'evento
         * @param oraFine ora di fine dell'evento
         * @param ripetizione flag che indica ogni quanto un evento deve ripetersi {0: mai, 1: ogni settimana, 2: ogni 2 settimane, 3: ogni mese}
         * @param fineRipetizione data in cui il numero di ripetizioni finiscono
         */
        private function inserimentoMomentiEventiSettimanale($conn, $idEvento, $inizioEvento, $scartoFineEvento, $luogo, $oraInizio, $oraFine, $ripetizione, $fineRipetizione)
        {
            //$interval = date_diff($scartoFineEvento, $inizioEvento);
            $dataEvento = date('Y-m-d', strtotime($inizioEvento->format('Y-m-d'). " + $ripetizione days"));
            while($dataEvento <= $fineRipetizione)
            {
                if($this->checkInizioFineEvento($conn, $idEvento, $dataEvento, $scartoFineEvento, $luogo, $oraInizio, $oraFine) != false)
                    $dataEvento = date('Y-m-d', strtotime($dataEvento. " + $ripetizione days"));
                else
                    return false;
            }
            return true;
        }

         /** Metodo per l'iserimento di un evento con cadenza ogni mese nella tabella "MomentiEventi" in base alla ripetizione dell'evento
         * @param idEvento id dell'evento
         * @param inizioEvento data di inizio dell'evento
         * @param scartoFineEvento scarto tra data di fine e di inizio di un evento continuo in più giorni
         * @param luogo luogo in cui si svolge l'evento
         * @param oraInizio ora di inizio dell'evento
         * @param oraFine ora di fine dell'evento
         * @param ripetizione flag che indica ogni quanto un evento deve ripetersi {0: mai, 1: ogni settimana, 2: ogni 2 settimane, 3: ogni mese}
         * @param fineRipetizione data in cui il numero di ripetizioni finiscono
         */
        private function inserimentoMomentiEventiMensile($conn, $idEvento, $inizioEvento, $scartoFineEvento, $luogo, $oraInizio, $oraFine, $ripetizione, $fineRipetizione)
        {
            $dataEvento = date('Y-m-d', strtotime($inizioEvento->format('Y-m-d'). " + $ripetizione months"));
            while($dataEvento <= $fineRipetizione)
            {
                if($this->checkInizioFineEvento($conn, $idEvento, $inizioEvento, $scartoFineEvento, $luogo, $oraInizio, $oraFine) != false)
                    $dataEvento = date('Y-m-d', strtotime($dataEvento. " + $ripetizione months"));
                else
                    return false;
            }
            return true;
        }

        /**
         * @param user utente per cui si vuole effettuare la ricerca
         * @return result risultato della query
        */
        public function changeUserData($user) {
            $message="";
            if($_POST["actpassword"]!="" && (($_POST["newpassword"]!="" && $_POST["confnewpassword"]!="") || $_POST["newmail"]!="")) {
                $stmt = self::$db->getConnection()->prepare("SELECT Password
                                                            FROM Utenze as u
                                                            WHERE u.IdUtente = ". $user->getUserId() . " AND u.Password = ?");
                $stmt->bind_param("s", hash("sha256", $_POST["actpassword"]));
                $result = self::$db->runStatement($stmt);
                $stmt->close();
                if($result->num_rows != 0) {
                    $message .= $this->changeUserPassword($user);
                    $message .= $this->changeUserMail($user);
                } else {
                    $message .= "Password attuale errata"."<br>";
                }
            } else {
                $message .= "Almeno un campo lasciato vuoto"."<br>";
            }
            return $message;
        }

        /**
         * @param user utente per cui si vuole effettuare la ricerca
         * @return result risultato della query
        */
        private function changeUserPassword($user) {
            $message="";
            if($_POST["newpassword"]!="" && $_POST["confnewpassword"]!="") {
                if(($_POST["newpassword"] == $_POST["confnewpassword"])) {
                    $stmt = self::$db->getConnection()->prepare("UPDATE Utenze
                                                                SET Password = ?
                                                                WHERE IdUtente = ".$user->getUserId());
                    $stmt->bind_param("s", hash("sha256", $_POST["newpassword"]));
                    $result = self::$db->runStatement($stmt);
                    $stmt->close();
                    if($result) {
                        $message .= "Password cambiata correttamente!";
                    } else {
                        $message .= "SQL error during password change";
                    }
                } else {
                    $message .= "Nuove password non corrispondenti";
                }
            } else {
                $message .= "Password NON modificata";
            }
            return $message."<br>";
        }

        /**
         * @param user utente per cui si vuole effettuare la ricerca
         * @return result risultato della query
        */
        private function changeUserMail($user) {
            $message="";
            if($_POST["newmail"]!="") {
                $stmt = self::$db->getConnection()->prepare("UPDATE Utenze
                                                            SET Mail = ?
                                                            WHERE IdUtente = ".$user->getUserId());
                $stmt->bind_param("s", $_POST['newmail']);
                $result = self::$db->runQuery($stmt);
                $stmt->close();
                if($result) {
                    $message .= "Mail cambiata correttamente!";
                } else {
                    $message .= "SQL error during email change";
                }
            } else {
                $message .= "Mail NON modificata";
            }
            return $message."<br>";
        }
    }
?>
