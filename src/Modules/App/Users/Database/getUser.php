<?php

namespace NT5\Bulker\Modules\App\Users\Database;

use NT5\Bulker\Modules\App\Users\UserEntry;
use NT5\Bulker\Modules\Util\Functions;

/**
 * 
 */
trait getUser {

    /**
     * @return \NT5\Bulker\Modules\Extended
     */
    public abstract function Extended();

    /**
     * 
     * @param int $id
     * @return UserEntry
     */
    public function getUser(int $id): UserEntry {

        $db = $this->Extended()->Database();

        $user_id = NULL;
        $user_type = NULL;
        $user_name = NULL;
        $user_phone = NULL;
        $user_createat = NULL;

        $stmt = $db->prepare("SELECT User_Id, User_Type, User_FullName, User_Phone, Create_at FROM User_Data WHERE User_Id = ?");

        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->bind_result($user_id, $user_type, $user_name, $user_phone, $user_createat);
        $stmt->store_result();
        $stmt->fetch();
        $stmt->free_result();
        $stmt->close();

        if (!Functions::mis_null($user_id, $user_type, $user_name, $user_phone, $user_createat)) {
            return new UserEntry($user_id, $user_type, $user_name, $user_phone, $user_createat);
        }

        return new UserEntry();
    }

}
