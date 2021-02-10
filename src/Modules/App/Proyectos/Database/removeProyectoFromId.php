<?php

namespace NT5\Bulker\Modules\App\Proyectos\Database;

use NT5\Bulker\Modules\Extended;

/**
 * 
 */
trait removeProyectoFromId {

    /**
     * @return Extended
     */
    public abstract function Extended();

    /**
     * 
     * @param int $id
     * @return boolean
     */
    public function removeProyectoFromId(int $id) {

        $db = $this->Extended()->Database();

        $stmt = $db->prepare("DELETE FROM Proyectos WHERE IdProyecto = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        if ($stmt->errno) {
            return false;
        }
        return true;
    }

}
