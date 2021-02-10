<?php

namespace NT5\Bulker\Modules\App\Users\Database;

use NT5\Bulker\Modules\App\Users\UserEntry;

trait removeUserFromId {

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
     * @param int $User_Id
     * @param int $User_Type
     * @return UserEntry
     */
    public function removeUserFromId(int $User_Id) {
        $db = $this->Extended()->Database();

        $stmt = $db->prepare("DELETE FROM User_Data WHERE User_Id = ?");
        $stmt->bind_param('i', $User_Id);
        $stmt->execute();
        if ($stmt->errno) {
            return false;
        }
        return true;
    }

}
