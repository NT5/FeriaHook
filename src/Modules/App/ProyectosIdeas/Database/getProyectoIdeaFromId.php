<?php

namespace NT5\Bulker\Modules\App\ProyectosIdeas\Database;

use NT5\Bulker\Modules\App\ProyectosIdeas\ProyectosIdeasEntry;
use NT5\Bulker\Modules\Util\Functions;
use NT5\Bulker\Modules\Extended;

/**
 * 
 */
trait getProyectoIdeaFromId {

    /**
     * @return Extended
     */
    public abstract function Extended();

    /**
     * 
     * @param int $id
     * @return ProyectosIdeasEntry
     */
    public function getProyectoIdeaFromId(int $id): ProyectosIdeasEntry {

        $db = $this->Extended()->Database();

        $IdProyecto = NULL;
        $NombreCreador = NULL;
        $TelefonoCreador = NULL;
        $CorreoCreador = NULL;
        $DescripcionProyecto = NULL;
        $CreateAt = NULL;

        $stmt = $db->prepare("SELECT IdProyecto, NombreCreador, TelefonoCreador, CorreoCreador, DescripcionProyecto, CreateAt FROM ProyectosIdeas WHERE IdProyecto = ?");

        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->bind_result($IdProyecto, $NombreCreador, $TelefonoCreador, $CorreoCreador, $DescripcionProyecto, $CreateAt);
        $stmt->store_result();
        $stmt->fetch();
        $stmt->free_result();
        $stmt->close();

        if (!Functions::mis_null($IdProyecto, $NombreCreador, $TelefonoCreador, $CorreoCreador, $DescripcionProyecto, $CreateAt)) {
            return new ProyectosIdeasEntry($IdProyecto, $NombreCreador, $TelefonoCreador, $CorreoCreador, $DescripcionProyecto, $CreateAt);
        }

        return new ProyectosIdeasEntry();
    }

}
