<?php

namespace NT5\Bulker\Modules\App\Proyectos\Database;

use NT5\Bulker\Modules\App\Proyectos\ProyectoEntry;
use NT5\Bulker\Modules\Extended;

/**
 * 
 */
trait getProyectoListFromCategoriaId {

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
     * @param int $IdCategoria
     * @return ProyectoEntry[]
     */
    public function getProyectoListFromCategoriaId(int $IdCategoria) {
        $db = $this->Extended()->Database();

        $proyectos = [];
        $proyecto_id = NULL;

        $stmt = $db->prepare("SELECT IdProyecto FROM Proyectos WHERE IdCategoria = ? ORDER BY IdProyecto");
        $stmt->bind_param('i', $IdCategoria);
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
