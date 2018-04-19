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

        public function getUserCommunication($user, $return_format = null)
        {
            $sql = "select e.Nome, c.Titolo
                    from Comunicazioni as c join Eventi as e on (c.IdEvento = e.IdEvento)
                    where c.IdEvento in (
                        select m.IdEvento
                        from MomentiEventi as m join Partecipanti as p on (m.IdMomento = p.IdMomento)
                        where p.IdPartecipante = $user->getUserId())
                    order by c.Data, c.Ora
                    limit 5;";
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
