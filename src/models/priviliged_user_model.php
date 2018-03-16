<?php

$var = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/utils/db_utils.php";
require_once($var);
require_once("role_model.php");
require_once("user_model.php");
session_start();

class PrivilegedUser extends User
{
    private $roles;

    /** Costruttore per la creazione dell'utente */
    public function __construct($username, $password)
    {
        parent::__construct($username, $password);
        self::initRoles();
        $_SESSION["logged"] = true;
        $_SESSION["user"] = serialized($this);
    }

    /**
     * Metodo per inizializzare i permessi di un ruolo
     */
    public function initRoles() {
        $this->roles = array();
        $sql = "SELECT u_r.role_id, r.role_name 
                FROM user_role as u_r JOIN roles as r ON u_r.role_id = r.role_id
                WHERE u_r.user_id = '$this->user_id'";
        $result = self::$db->runQuery($sql);
        if($result != false)
        {
            while($row = $result->fetch_assoc())
            {
                $this->roles[$row["role_name"]] = Role::getRolePerms($row["role_id"]);
            }
        }
    }

    /**
     * @param perm permesso da controllare
     * @return TRUE/FALSE true: l'utente ha il permesso / false: l'utente non ha il permesso
     */
    public function hasPrivilege($perm) {
        if(!isempy($this->roles))
        {
            foreach ($this->roles as $role) {
                if ($role->hasPerm($perm)) {
                    return true;
                }
            }
        }
        return false;
    }
}