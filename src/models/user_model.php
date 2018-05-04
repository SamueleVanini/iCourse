<?php
    $var = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/utils/db_utils.php";
    require_once($var);

    class User
    {
        protected $user_id;
        protected $user_matricola;
        protected $username;
        protected static $db;
        private $course_list = [];
        private $class = [];

        /**
        * @param $username username dell'utente
        * @param $password password dell'utente
        */
        public function __construct($username, $password)
        {
            self::$db = new Db();
            $stmt = self::$db->getConnection()->prepare("SELECT * FROM Utenze WHERE (Username = ? or Matricola = ?) and password = ?");
            $stmt->bind_param("sss", $username, $username, $password);
            $result = self::$db->runStatement($stmt);
            $stmt->close();
            $result_array = $result->fetch_all(MYSQLI_ASSOC);
            if($result->num_rows != 0)
            {

                $this->user_id = $result_array[0]["IdUtente"];
                $this->user_matricola = $result_array[0]["Matricola"];
                $this->username = $result_array[0]["Username"];
                $result->close(); //libera la risorsa risultati
            }
            else
            {
                self::$db->error_list[] = "Login error, le tue credenziali non sono valide";
            } //if-else
        } //__construct

        /**
         * @return user_id username dell'utente loggato
         */
        public function getUserId()
        {
            return $this->user_id;
        }

        /**
        * @return lista degli errori per l'utente $this
        */
        public function getErrorList()
        {
            return self::$db->error_list;
        } //getErrorList
    }

    class UserSearcher
    {
        protected static $db;

        /** Costruttore di default */
        public function __construct()
        {
            self::$db = new Db();
        }

        public function getAllUser($return_format = null)
        {
            $sql = "SELECT Nome, Cognome, Matricola FROM Utenze as u join Classi as c on u.IdClasse = c.IdClasse";
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
    }
?>
