<?php

namespace NT5\Bulker\Modules\App\Votacion\Database;

use NT5\Bulker\Modules\Extended;

/**
 * 
 */
trait setVotacionStateDisable {

    /**
     * @return Extended
     */
    public abstract function Extended();

    /**
     * 
     * @return bool
     */
    public function setVotacionStateDisable() {

        $db = $this->Extended()->Database();
        $stmt = $db->prepare("UPDATE Votacion_State SET State = 0");

        $stmt->execute();
        $stmt->close();
    }

}
