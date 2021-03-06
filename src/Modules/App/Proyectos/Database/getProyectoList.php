<?php

namespace NT5\Bulker\Modules\App\Proyectos\Database;

use NT5\Bulker\Modules\App\Proyectos\ProyectoEntry;
use NT5\Bulker\Modules\Extended;

/**
 * 
 */
trait getProyectoList {

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
     * @return ProyectoEntry[]
     */
    public function getProyectoList() {
        $db = $this->Extended()->Database();

        $proyectos = [];
        $proyecto_id = NULL;

        $stmt = $db->prepare("SELECT P.IdProyecto, COUNT(PL.IdLike) AS Likes FROM Proyectos AS P LEFT JOIN ProyectosLikes AS PL ON P.IdProyecto = PL.IdProyecto GROUP BY(P.IdProyecto) ORDER BY Likes DESC");
        $stmt->execute();
        $stmt->bind_result($proyecto_id, $Likes);
        $stmt->store_result();
        while ($stmt->fetch()) {
            $proyectos[] = $this->getProyectoFromId($proyecto_id);
        }
        $stmt->free_result();
        $stmt->close();

        return $proyectos;
    }

}
