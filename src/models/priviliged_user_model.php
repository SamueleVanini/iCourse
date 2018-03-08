<?php

include_once("../utils/db.php");
include_once("role.php");
include_once("user.php");

class PrivilegedUser extends User
{
    private $roles;

    public function __construct($username, $password)
    {
        parent::__construct($username, $password);
        self::initRoles();
    }

    /**
     * Metodo per inizializzare i permessi di un ruolo
     */
    protected function initRoles() {
        $this->roles = array();
        $sql = "SELECT u_r.role_id, r.role_name 
                FROM user_role as u_r JOIN roles as r ON u_r.role_id = r.role_id
                WHERE u_r.user_id = '$this->user_id'";
        $result = self::$db->runQuery($sql);

        while($row = $result->fetch_assoc())
        {
            $this->roles[$row["role_name"]] = Role::getRolePerms($row["role_id"]);
        }
    }

    /**
     * @param perm permesso da controllare
     * @return TRUE/FALSE true: l'utente ha il permesso / false: l'utente non ha il permesso
     */
    public function hasPrivilege($perm) {
        foreach ($this->roles as $role) {
            if ($role->hasPerm($perm)) {
                return true;
            }
        }
        return false;
    }
}