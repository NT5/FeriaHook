<?php

namespace NT5\Bulker\Modules\App\Users\Database;

use NT5\Bulker\Modules\App\Users\UserEntry;

trait setUserType {

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
    public function setUserType(int $User_Id, int $User_Type) {
        $db = $this->Extended()->Database();

        $stmt = $db->prepare("UPDATE User_Data SET User_Type=? WHERE User_Id=?");
        $stmt->bind_param('ii', $User_Type, $User_Id);
        $stmt->execute();

        if ($stmt->errno) {
            return new UserEntry();
        } else {
            return $this->getUser($User_Id);
        }
    }

}
