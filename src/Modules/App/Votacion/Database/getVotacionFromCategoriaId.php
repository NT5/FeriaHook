<?php

namespace NT5\Bulker\Modules\App\Votacion\Database;

use NT5\Bulker\Modules\App\Votacion\VotacionEntry;
use NT5\Bulker\Modules\Extended;

/**
 * 
 */
trait getVotacionFromCategoriaId {

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
     * @param int $categoria_id
     * @return VotacionEntry[]
     */
    public function getVotacionFromCategoriaId(int $categoria_id) {

        $db = $this->Extended()->Database();

        $IdVoto = NULL;
        $List = [];

        $stmt = $db->prepare("SELECT IdVoto FROM Votacion INNER JOIN Proyectos ON Proyectos.IdProyecto = Votacion.IdProyecto WHERE Proyectos.IdCategoria = ?");

        $stmt->bind_param('i', $categoria_id);
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
