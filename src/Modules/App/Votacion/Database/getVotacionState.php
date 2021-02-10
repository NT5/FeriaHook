<?php

namespace NT5\Bulker\Modules\App\Votacion\Database;

use NT5\Bulker\Modules\Extended;

/**
 * 
 */
trait getVotacionState {

    /**
     * @return Extended
     */
    public abstract function Extended();

    /**
     * 
     * @return bool
     */
    public function getVotacionState() {

        $db = $this->Extended()->Database();

        $State = NULL;

        $stmt = $db->prepare("SELECT State FROM Votacion_State ORDER BY CreateAt DESC");

        $stmt->execute();
        $stmt->bind_result($State);
        $stmt->store_result();
        $stmt->fetch();
        $stmt->free_result();
        $stmt->close();

        return ($State !== NULL && $State == 1 ? TRUE : FALSE);
    }

}
