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
         * non indicato/default -> array associativo formattato in json;
         * @return result risultato della query
        */
        public function getAll($return_format = null)
        {
            $sql = "SELECT * FROM Eventi";
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

        /** Metodo per l'iserimento di un evento nella tabella Eventi e dell'isegnate con l'evento nella tabella GestioneEventi
         * @param user utente che effettua l'inserimento
         * @param nome nome dell'evento
         * @param descrizione descrizione dell'evento
         * @return true/false indica se l'inserimento è andato a buon fine 
         */
        public function insertEvent($user, $nome, $descrizione, $inizioEvento, $fineEvento, $luogo, $riperizione = null)
        {
            $stmt = self::$db->getConnection()->prepare("INSERT INTO Eventi ('Descrizione', 'Nome') 
                                                         VALUES(?, ?)");
            $stmt->bind_param("ss", $descrizione, $nome);
            $result = self::$db->runStatement($stmt);
            $stmt->close();
            if($result != false)
            {
                $stmt = self::$db->getConnection()->prepare("SELECT IdEvento FROM Eventi WHERE Nome = ?");
                $stmt->bind_param("s", $nome);
                $result = self::$db->runStatement($stmt);
                $stmt->close();
                $result_array = $result->fetch_all(MYSQLI_ASSOC);
                $idEvento = $result_array["IdEvento"];
                $userId = $user->getUserId();
                $sql = "INSERT INTO GestioneEventi ('IdEvento', 'IdInsegnante') 
                        VALUES(".$idEvento.",".$userId.")";
                $result = self::$db->runQuery($sql);
                if($result === false)
                    return $result;
                else
                    return true;
            }
            else
            {
                return false;
            }
        }

        /*
        public function momentiEventi($idEvento, $inizioEvento, $fineEvento, $luogo, $ripetizione)
        {
            switch($ripetizione)
            {
                case 1:
                    $numberEvent =  
                case 2:

                case 3:

                default:
            }
        } */
        /**
         * @param user utente per cui si vuole effettuare la ricerca
         * @return result risultato della query
        */
        public function changeUserData($user) {
            $message="";
            if($_POST["actpassword"]!="" && (($_POST["newpassword"]!="" && $_POST["confnewpassword"]!="") || $_POST["newmail"]!="")) {
                $stmt = self::$db->getConnection()->prepare("SELECT Password
                                                            FROM Utenze as u
                                                            WHERE u.IdUtente = ? AND u.Password = '?'");
                $stmt->bind_param("is", $user->getUserId(), hash("sha256", $_POST["actpassword"]));
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
                                                                SET Password = '?'
                                                                WHERE IdUtente = ?");
                    $stmt->bind_param("si", hash("sha256", $_POST["newpassword"]), $user->getUserId());
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
                                                            SET Mail = '?'
                                                            WHERE IdUtente = ?");
                $stmt->bind_param("si", $_POST['newmail'], $user->getUserId());
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
