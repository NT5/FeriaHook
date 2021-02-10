<?php

namespace NT5\Bulker\Modules\App\Proyectos\Database;

use NT5\Bulker\Modules\App\Proyectos\ProyectoEntry;
use NT5\Bulker\Modules\Extended;

/**
 * 
 */
trait registreProyecto {

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
     * @param string $NombreProyecto
     * @param string $Descripcion
     * @param int $Internet
     * @param int $Electricidad
     * @param int $EsInvestigacion
     * @param int $IdCarrera
     * @param int $IdAsignatura
     * @param int $IdTutor
     * @param int $IdCategoria
     * @return ProyectoEntry
     */
    public function registreProyecto(string $NombreProyecto, string $Descripcion, int $Internet, int $Electricidad, int $EsInvestigacion, int $IdCarrera, int $IdAsignatura, int $IdTutor, int $IdCategoria) {

        $db = $this->Extended()->Database();

        $stmt = $db->prepare("INSERT INTO Proyectos (NombreProyecto, Descripcion, Internet, Electricidad, EsInvestigacion, IdCarrera, IdAsignatura, IdTutor, IdCategoria) VALUES(?, ? ,? ,?, ?, ?, ?, ?, ?)");

        $stmt->bind_param('ssiiiiiii', $NombreProyecto, $Descripcion, $Internet, $Electricidad, $EsInvestigacion, $IdCarrera, $IdAsignatura, $IdTutor, $IdCategoria);
        $stmt->execute();

        if ($stmt->errno) {
            return new ProyectoEntry();
        } else {
            $id = $db->getLastId();
            return $this->getProyectoFromId($id);
        }
    }

}
