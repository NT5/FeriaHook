<?php

namespace NT5\Bulker\Modules\App\Asignaturas\Database;

use NT5\Bulker\Modules\Extended;

/**
 * 
 */
trait getAsignaturaCount {

    /**
     * @return Extended
     */
    public abstract function Extended();

    /**
     * 
     * @return int
     */
    public function getAsignaturaCount() {

        $db = $this->Extended()->Database();

        $count = NULL;
        $stmt = $db->prepare("SELECT COUNT(IdAsignatura) FROM Asignaturas");
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->store_result();
        $stmt->fetch();
        $stmt->free_result();
        $stmt->close();

        return ($count ?: 0);
    }

}
