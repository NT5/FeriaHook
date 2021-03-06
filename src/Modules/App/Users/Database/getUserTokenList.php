<?php

namespace NT5\Bulker\Modules\App\Users\Database;

use NT5\Bulker\Modules\App\Users\UserEntry;
use NT5\Bulker\Modules\Extended;

/**
 * 
 */
trait getUserTokenList {

    /**
     * @return Extended
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
     * @return array
     */
    public function getUserTokenList() {
        $db = $this->Extended()->Database();

        $list = [];
        $id = NULL;
        $token = NULL;

        $stmt = $db->prepare("SELECT User_Id, User_Token FROM User_Token ORDER BY Create_at DESC");
        $stmt->execute();
        $stmt->bind_result($id, $token);
        $stmt->store_result();
        while ($stmt->fetch()) {
            array_push($list, [
                "token" => strval($token),
                "user" => $this->getUser($id)
            ]);
        }
        $stmt->free_result();
        $stmt->close();

        return $list;
    }

}
