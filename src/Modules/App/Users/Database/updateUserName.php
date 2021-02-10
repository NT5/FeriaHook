<?php

namespace NT5\Bulker\Modules\App\Users\Database;

use NT5\Bulker\Modules\App\Users\UserEntry;

trait updateUserName {

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
     * @param int $User_FullName
     * @return UserEntry
     */
    public function updateUserName(int $User_Id, string $User_FullName) {
        $db = $this->Extended()->Database();

        $stmt = $db->prepare("UPDATE User_Data SET User_FullName = ? WHERE User_Id = ?");
        $stmt->bind_param('si', $User_FullName, $User_Id);
        $stmt->execute();

        if ($stmt->errno) {
            return new UserEntry();
        } else {
            return $this->getUser($User_Id);
        }
    }

}
