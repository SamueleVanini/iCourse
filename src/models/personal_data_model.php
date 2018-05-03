<?php
    $var = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/utils/db_utils.php";
    require_once($var);

    class PersonalDataModel {

        protected static $db;

        /** Costruttore di default */
        public function __construct()
        {
            self::$db = new Db();
        }

        /**
         * @param user utente per cui si vuole effettuare la ricerca
         * @return result risultato della query
        */
        public function viewUserData($user, $return_format = null) {
            $sql = "SELECT u.Nome, u.Cognome, u.DataDiNascita, u.Matricola, c.Anno, c.Corso, c.Sezione, u.Mail, u.Telefono
                        FROM Utenze as u left join Classi as c on (u.IdClasse = c.IdClasse)
                        WHERE u.IdUtente = ".$user->getUserId().";";
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
         * @param user utente per cui si vuole effettuare la modifica
         * @return result risultato della query
        */
        public function changeUserData($user) {
            $message="";
            if($_POST["actpassword"]!="" && (($_POST["newpassword"]!="" && $_POST["confnewpassword"]!="") || $_POST["newmail"]!="" || $_POST["newphone"]!="")) {
                $stmt = self::$db->getConnection()->prepare("SELECT Password
                                                            FROM Utenze as u
                                                            WHERE u.IdUtente = ". $user->getUserId() . " AND u.Password = ?");
                $stmt->bind_param("s", hash("sha256", $_POST["actpassword"]));
                $result = self::$db->runStatement($stmt);
                $stmt->close();
                if($result->num_rows != 0) {
                    $message .= $this->changeUserPassword($user);
                    $message .= $this->changeUserMail($user);
                    $message .= $this->changeUserPhone($user);
                } else {
                    $message .= "Password attuale errata"."<br>";
                }
            } else {
                $message .= "Almeno un campo lasciato vuoto"."<br>";
            }
            return $message;
        }

        /**
         * @param user utente per cui si vuole effettuare la modifica
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
         * @param user utente per cui si vuole effettuare la modifica
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

        /**
         * @param user utente per cui si vuole effettuare la modifica
         * @return result risultato della query
        */
        private function changeUserPhone($user) {
            $message="";
            if($_POST["newphone"]!="") {
                $stmt = self::$db->getConnection()->prepare("UPDATE Utenze
                                                            SET Telefono = ?
                                                            WHERE IdUtente = ".$user->getUserId());
                $stmt->bind_param("i", $_POST['newphone']);
                $result = self::$db->runQuery($stmt);
                $stmt->close();
                if($result) {
                    $message .= "Telefono cambiato correttamente!";
                } else {
                    $message .= "SQL error during phone change";
                }
            } else {
                $message .= "Telefono NON modificata";
            }
            return $message."<br>";
        }
    }
?>
