<?php

namespace NT5\Bulker\Modules\App\Votacion\Database;

use NT5\Bulker\Modules\App\Votacion\VotacionEntry;
use NT5\Bulker\Modules\Extended;

/**
 * 
 */
trait getVotacionFromProyectoId {

    /**
     * @return Extended
     */
    public abstract function Extended();

    /**
     * @return VotacionEntry
     */
    public abstract function getVotacionFromId(int $id);

    /**
     * 
     * @param int $id
     * @return VotacionEntry[]
     */
    public function getVotacionFromProyectoId(int $id) {

        $db = $this->Extended()->Database();

        $IdVoto = NULL;
        $List = [];

        $stmt = $db->prepare("SELECT IdVoto FROM Votacion WHERE IdProyecto = ?");

        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->bind_result($IdVoto);
        $stmt->store_result();
        $stmt->store_result();
        while ($stmt->fetch()) {
            $List[] = $this->getVotacionFromId($IdVoto);
        }
        $stmt->free_result();
        $stmt->close();
        return $List;
    }

}
