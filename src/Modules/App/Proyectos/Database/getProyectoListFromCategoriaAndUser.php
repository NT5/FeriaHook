<?php

namespace NT5\Bulker\Modules\App\Proyectos\Database;

use NT5\Bulker\Modules\App\Proyectos\ProyectoEntry;
use NT5\Bulker\Modules\Extended;

/**
 * 
 */
trait getProyectoListFromCategoriaAndUser {

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
     * param int $UserId
     * @param int $IdCategoria
     * @return ProyectoEntry[]
     */
    public function getProyectoListFromCategoriaAndUser(int $UserId, int $IdCategoria) {
        $db = $this->Extended()->Database();

        $proyectos = [];
        $proyecto_id = NULL;

        $stmt = $db->prepare("SELECT IdProyecto FROM Proyectos WHERE IdTutor = ? AND IdCategoria = ? ORDER BY IdProyecto");
        $stmt->bind_param('ii', $UserId, $IdCategoria);
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
