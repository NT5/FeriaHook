<?php

namespace NT5\Bulker\Modules\App\Users\Database;

use NT5\Bulker\Modules\App\Users\UserEntry;

trait registerUser {

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
     * @param string $User_FullName
     * @param string $User_Phone
     * @return UserEntry
     */
    public function registerUser(string $User_FullName, string $User_Phone) {
        $db = $this->Extended()->Database();

        $stmt = $db->prepare("INSERT INTO User_Data (User_FullName, User_Phone) VALUES(?, ?)");
        $stmt->bind_param('ss', $User_FullName, $User_Phone);
        $stmt->execute();

        if ($stmt->errno) {
            return new UserEntry();
        } else {
            $id = $db->getLastId();
            return $this->getUser($id);
        }
    }

}
