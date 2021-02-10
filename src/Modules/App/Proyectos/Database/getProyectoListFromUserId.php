<?php

namespace NT5\Bulker\Modules\App\Proyectos\Database;

use NT5\Bulker\Modules\App\Proyectos\ProyectoEntry;
use NT5\Bulker\Modules\Extended;

/**
 * 
 */
trait getProyectoListFromUserId {

    /**
     * @return Extended
     */
    public abstract function Extended();

    /**
     * 
     * @param int $id
     * @return ProyectoEntry
     */
    public abstract function getProyectoFromId(int $id): ProyectoEntry;

    /**
     * 
     * @param int $UserId
     * @return ProyectoEntry[]
     */
    public function getProyectoListFromUserId(int $UserId) {
        $db = $this->Extended()->Database();

        $proyectos = [];
        $proyecto_id = NULL;

        $stmt = $db->prepare("SELECT IdProyecto FROM Proyectos WHERE IdTutor = ? ORDER BY IdProyecto");
        $stmt->bind_param('i', $UserId);
        $stmt->execute();
        $stmt->bind_result($proyecto_id);
        $stmt->store_result();
        while ($stmt->fetch()) {
            $proyectos[] = $this->getProyectoFromId($proyecto_id);
        }
        $stmt->free_result();
        $stmt->close();

        return $proyectos;
    }

}
