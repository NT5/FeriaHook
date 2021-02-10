<?php

namespace NT5\Bulker\Modules\App\Proyectos\Database;

use NT5\Bulker\Modules\Extended;

/**
 * 
 */
trait dislikeProyectoFromId {

    /**
     * @return Extended
     */
    public abstract function Extended();

    /**
     * 
     * @param int $id
     * @param string $device
     * @return boolean
     */
    public function dislikeProyectoFromId(int $id, string $device) {

        $db = $this->Extended()->Database();

        $stmt = $db->prepare("DELETE FROM ProyectosLikes WHERE IdProyecto = ? AND Device = ?");
        $stmt->bind_param('is', $id, $device);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            return true;
        }
        return false;
    }

}
