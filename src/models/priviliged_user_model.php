<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}   
    $var = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/utils/db_utils.php";
    require_once($var);
    require_once("role_model.php");
    require_once("user_model.php");

class PrivilegedUser extends User
{
    private $roles;

    /** Costruttore per la creazione dell'utente */
    public function __construct($username, $password)
    {
        parent::__construct($username, $password);
        self::initRoles();
    }

    /**
     * Metodo per inizializzare i permessi di un ruolo
     */
    public function initRoles() {
        $this->roles = array();
        $sql = "SELECT u_r.IdRuolo, r.Nome FROM RuoloUtente as u_r JOIN Ruoli as r ON u_r.IdRuolo = r.IdRuolo WHERE u_r.IdUtente = $this->user_id";
        $result = self::$db->runQuery($sql);
        if($result != false)
        {
            while($row = $result->fetch_assoc())
            {
                $this->roles[$row["Nome"]] = Role::getRolePerms($row["IdRuolo"]);
            }
        }
    }

    /**
     * @param perm permesso da controllare
     * @return TRUE/FALSE true: l'utente ha il permesso / false: l'utente non ha il permesso
     */
    public function hasPrivilege($perm) {
        if(!empty($this->roles))
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
?>
