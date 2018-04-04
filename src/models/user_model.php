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
            $sql = "SELECT * FROM Utenze WHERE (Username = '$username' or Matricola = '$username') and password = '$password'";
            $result = self::$db->runQuery($sql);
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

        /**
         * Recupera la lista dei corsi di un utente
         */
        public function get_course_list() {}

        /**
         * Rcupera la lista delle classi a cui si appartiene (1 se studente, 1+ se professore)
         */
        public function get_class() {}

        /**
         * Setta la lista dei corsi di un utente
         */
        public function add_course() {}

        /**
         * Setta la lista dei corsi di un utente
         */
        public function remove_course() {}

        /**
         * Setta la lista delle classi a cui si appartiene (1 se studente, 1+ se professore)
         */
        public function add_class() {}

        /**
         * Setta la lista delle classi a cui si appartiene (1 se studente, 1+ se professore)
         */
        public function remove_class() {}
    }
?>
