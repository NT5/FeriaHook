<?php

namespace NT5\Bulker\Modules\App\Votacion\Database;

use NT5\Bulker\Modules\App\Votacion\VotacionEntry;
use NT5\Bulker\Modules\Extended;

/**
 * 
 */
trait getVotacionFromProyectoAndUserId {

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
     * @param int $proyecto_id
     * @param int $user_id
     * @return VotacionEntry
     */
    public function getVotacionFromProyectoAndUserId(int $proyecto_id, int $user_id): VotacionEntry {

        $db = $this->Extended()->Database();

        $IdVoto = NULL;

        $stmt = $db->prepare("SELECT IdVoto FROM Votacion WHERE IdProyecto = ? AND IdUser = ?");

        $stmt->bind_param('ii', $proyecto_id, $user_id);
        $stmt->execute();
        $stmt->bind_result($IdVoto);
        $stmt->store_result();
        $stmt->fetch();
        $stmt->free_result();
        $stmt->close();
        if ($IdVoto) {
            return $this->getVotacionFromId($IdVoto);
        }
        return new VotacionEntry();
    }

}
