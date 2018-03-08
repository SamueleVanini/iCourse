<?php

include_once("../utils/db.phps");

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
        $sql = "SELECT p.perm_desc, p.perm_id
                FROM role_perm as r_p JOIN permissions as p ON r_p.perm_id = p.perm_id
                WHERE r_p.role_id = $role_id";
        $result = $db->runQuery($sql);

        while($row = $result->fetch_assoc())
        {
            $role->permissions[$row["perm_id"]] = array(true, $row["perm_desc"]);
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