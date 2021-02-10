<?php

namespace NT5\Bulker\Modules\App\Users\Database;

use NT5\Bulker\Modules\App\Users\UserEntry;

trait getUserBySession {

    /**
     * @return \NT5\Bulker\Modules\Extended
     */
    public abstract function Extended();

    /**
     * 
     * @param int $id
     * @return UserEntry
     */
    public abstract function getUser(int $id): UserEntry;

    /**
     * 
     * @param string $session_token
     * @return UserEntry
     */
    public function getUserBySession($session_token) {
        $db = $this->Extended()->Database();

        $db_id = NULL;

        $stmt = $db->prepare("SELECT User_Id FROM User_Sessions WHERE BINARY Session_Token = ?");

        $stmt->bind_param('s', $session_token);
        $stmt->execute();
        $stmt->bind_result($db_id);
        $stmt->store_result();
        $stmt->fetch();
        $stmt->free_result();
        $stmt->close();

        if ($db_id) {
            return $this->getUser($db_id);
        }
        return new UserEntry();
    }

}
