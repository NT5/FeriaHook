<?php

namespace NT5\Bulker\Modules\App\ProyectosIdeas\Database;

use NT5\Bulker\Modules\App\ProyectosIdeas\ProyectosIdeasEntry;
use NT5\Bulker\Modules\Extended;

/**
 * 
 */
trait registreIdeaProyecto {

    /**
     * @return Extended
     */
    public abstract function Extended();

    /**
     * 
     * @param int $id
     * @return ProyectosIdeasEntry
     */
    public abstract function getProyectoIdeaFromId(int $id): ProyectosIdeasEntry;

    /**
     * 
     * @param string $NombreCreador
     * @param string $TelefonoCreador
     * @param string $CorreoCreador
     * @param string $DescripcionProyecto
     * @return ProyectosIdeasEntry
     */
    public function registreIdeaProyecto(string $NombreCreador, string $TelefonoCreador, string $CorreoCreador, string $DescripcionProyecto) {

        $db = $this->Extended()->Database();

        $stmt = $db->prepare("INSERT INTO ProyectosIdeas (NombreCreador, TelefonoCreador, CorreoCreador, DescripcionProyecto) VALUES(?, ?, ?, ?)");

        $stmt->bind_param('ssss', $NombreCreador, $TelefonoCreador, $CorreoCreador, $DescripcionProyecto);
        $stmt->execute();

        if ($stmt->errno) {
            return new ProyectosIdeasEntry();
        } else {
            $id = $db->getLastId();
            return $this->getProyectoIdeaFromId($id);
        }
    }

}
