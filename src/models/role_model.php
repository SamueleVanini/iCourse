<?php

$var = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/utils/db_utils.php";
require_once($var);

class Role
{
    protected $permissions;

    protected function __construct()
    {
        $this->permissions = array();
    }

    /**
     * Funzione che ritorna uno specifico ruolo con le sue permissioni
     * @param $role_id id del ruolo
     * @return role object
     */
    public static function getRolePerms($role_id)
    {
        $role = new Role();
        $db = new Db();
        $sql = "SELECT p.Nome, p.IdPermesso FROM RuoloPermesso as r_p JOIN Permessi as p ON r_p.IdPermesso = p.IdPermesso WHERE r_p.IdRuolo = $role_id";
        $result = $db->runQuery($sql);

        while($row = $result->fetch_assoc())
        {
            $role->permissions[$row["IdPermesso"]] = array(true, $row["Nome"]);
        }
        return $role;
    }

    /**
     * @param permissions permesso che si vuole controllare
     * @return TRUE/FALSE true: il ruolo ha il permesso / false: il ruolo non ha il permesso
     */
    public function hasPerm($permissions)
    {
        return isset($this->permissions[$permissions]);
    }
}
?>