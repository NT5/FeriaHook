<?php

namespace NT5\Bulker\Modules\App\Users\Database;

use NT5\Bulker\Modules\App\Users\UserEntry;

trait registerUserSession {

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
     * @param int $user_id
     * @param string $session_token
     * @return UserEntry
     */
    public function registerUserSession(int $user_id, string $session_token) {
        $db = $this->Extended()->Database();

        $stmt = $db->prepare("INSERT INTO User_Sessions (User_Id, Session_Token) VALUES(?, ?)");
        $stmt->bind_param('is', $user_id, $session_token);
        $stmt->execute();

        if ($stmt->errno) {
            return new UserEntry();
        } else {
            $id = $db->getLastId();
            return $this->getUser($id);
        }
    }

}
