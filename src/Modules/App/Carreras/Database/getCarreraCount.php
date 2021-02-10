<?php

namespace NT5\Bulker\Modules\App\Carreras\Database;

use NT5\Bulker\Modules\Extended;

/**
 * 
 */
trait getCarreraCount {

    /**
     * @return Extended
     */
    public abstract function Extended();

    /**
     * 
     * @return int
     */
    public function getCarreraCount() {

        $db = $this->Extended()->Database();

        $count = NULL;
        $stmt = $db->prepare("SELECT COUNT(IdCarrara) FROM Carreras");
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->store_result();
        $stmt->fetch();
        $stmt->free_result();
        $stmt->close();

        return ($count ?: 0);
    }

}
