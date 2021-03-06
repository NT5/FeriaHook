<?php

namespace NT5\Bulker\Modules\App\Proyectos\Database;

use NT5\Bulker\Modules\Extended;

/**
 * 
 */
trait likeProyectoFromId {

    /**
     * @return Extended
     */
    public abstract function Extended();

    /**
     * 
     * @param int $id
     * @pararm string $device
     * @return boolean
     */
    public function likeProyectoFromId(int $id, string $device) {

        $db = $this->Extended()->Database();

        $stmt = $db->prepare("INSERT INTO ProyectosLikes (IdProyecto, Device) VALUES (?, ?)");
        $stmt->bind_param('is', $id, $device);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            return true;
        }
        return false;
    }

}
