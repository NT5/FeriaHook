<?php

namespace NT5\Bulker\Modules\App\Carreras\Database;

use NT5\Bulker\Modules\App\Carreras\CarreraEntry;
use NT5\Bulker\Modules\Util\Functions;
use NT5\Bulker\Modules\Extended;

/**
 * 
 */
trait getCarreraFromId {

    /**
     * @return Extended
     */
    public abstract function Extended();

    /**
     * 
     * @param int $id
     * @return CarreraEntry
     */
    public function getCarreraFromId(int $id): CarreraEntry {

        $db = $this->Extended()->Database();

        $carrera_id = NULL;
        $carrera_nombre = NULL;
        $carrera_code = NULL;
        $carrera_createat = NULL;

        $stmt = $db->prepare("SELECT IdCarrara, CodCarrera, NombreCarrera, CreateAt FROM Carreras WHERE IdCarrara = ?");

        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->bind_result($carrera_id, $carrera_code, $carrera_nombre, $carrera_createat);
        $stmt->store_result();
        $stmt->fetch();
        $stmt->free_result();
        $stmt->close();

        if (!Functions::mis_null($carrera_id, $carrera_code, $carrera_nombre, $carrera_createat)) {
            return new CarreraEntry($carrera_id, $carrera_code, $carrera_nombre, $carrera_createat);
        }

        return new CarreraEntry();
    }

}
