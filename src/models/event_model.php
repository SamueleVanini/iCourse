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
            $sql = "SELECT p.IdEvento, p.Data, p.OraInizio, e.Nome, me.OraFine
                    FROM Partecipanti as p join Eventi as e on p.IdEvento = e.IdEvento join MomentiEventi as me on e.IdEvento = me.IdEvento
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

        /**
         * @param user utente per cui si vuole effettuare la ricerca
         * @return result risultato della query
        */
        public function changeUserPassword($user)
        {
            if($_POST["actpassword"]!="" && $_POST["newpassword"]!="" && $_POST["confnewpassword"]!="")
            {
                $sql = "SELECT Password
                          FROM Utenze as u
                          WHERE u.IdUtente = ".$user->getUserId()." AND u.Password = '".hash("sha256", $_POST["actpassword"])."'";
                $result = self::$db->runQuery($sql);
                if($result->num_rows != 0)
                {
                    if($_POST["newpassword"] == $_POST["confnewpassword"])
                    {
                        $sql = "UPDATE Utenze
                                SET Password = '".hash("sha256", $_POST['newpassword'])."'"
                                ."WHERE IdUtente = ".$user->getUserId();
                        $result = self::$db->runQuery($sql);
                        if($result)
                        {
                            return "Password cambiata correttamente";
                        } else {
                            return "Errore";
                        }
                    } else {
                        return "Nuove password non corrispondenti";
                    }
                } else {
                    return "Password attuale errata";
                }
            } else {
                return "Almeno un campo lasciato vuoto";
            }
        }
    }
?>
