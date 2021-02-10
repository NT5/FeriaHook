<?php

namespace NT5\Bulker\Modules\App\Votacion\Database;

use NT5\Bulker\Modules\Extended;

/**
 * 
 */
trait setVotacionStateActive {

    /**
     * @return Extended
     */
    public abstract function Extended();

    /**
     * 
     * @return bool
     */
    public function setVotacionStateActive() {

        $db = $this->Extended()->Database();
        $stmt = $db->prepare("UPDATE Votacion_State SET State = 1");

        $stmt->execute();
        $stmt->close();
    }

}
