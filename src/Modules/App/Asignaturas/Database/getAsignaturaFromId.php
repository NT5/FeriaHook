<?php

namespace NT5\Bulker\Modules\App\Asignaturas\Database;

use NT5\Bulker\Modules\App\Asignaturas\AsignaturaEntry;
use NT5\Bulker\Modules\Util\Functions;
use NT5\Bulker\Modules\Extended;

/**
 * 
 */
trait getAsignaturaFromId {

    /**
     * @return Extended
     */
    public abstract function Extended();

    /**
     * 
     * @param int $id
     * @return AsignaturaEntry
     */
    public function getAsignaturaFromId(int $id): AsignaturaEntry {

        $db = $this->Extended()->Database();

        $asignatura_id = NULL;
        $id_carrera = NULL;
        $cod_asignatura = NULL;
        $asignatura_nombre = NULL;
        $nivel = NULL;
        $asignatura_createat = NULL;

        $stmt = $db->prepare("SELECT IdAsignatura, IdCarrera, CodAsignatura, NombreAsignatura, Nivel, CreateAt FROM Asignaturas WHERE IdAsignatura = ?");

        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->bind_result($asignatura_id, $id_carrera, $cod_asignatura, $asignatura_nombre, $nivel, $asignatura_createat);
        $stmt->store_result();
        $stmt->fetch();
        $stmt->free_result();
        $stmt->close();

        if (!Functions::mis_null($asignatura_id, $id_carrera, $cod_asignatura, $asignatura_nombre, $nivel, $asignatura_createat)) {
            return new AsignaturaEntry($asignatura_id, $id_carrera, $cod_asignatura, $asignatura_nombre, $nivel, $asignatura_createat);
        }

        return new AsignaturaEntry();
    }

}
