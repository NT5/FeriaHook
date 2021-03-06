<?php

namespace NT5\Bulker\Application\Api\Areas\Proyectos;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Modules\App\Proyectos;
use NT5\Bulker\Modules\App\Proyectos\ProyectoEntry;
use NT5\Bulker\Application\Api\LoggedArea;

/**
 * 
 */
class updateProyecto extends LoggedArea {

    /**
     *
     * @var ProyectoEntry
     */
    private $ProyectoEntry;

    /**
     *
     * @var Proyectos
     */
    private $Proyectos;

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);
    }

    public function initVars() {
        $this->setVars([
            'proyecto' => $this->ProyectoEntry->getJson()
        ]);
    }

    public function CheckPost() {

        $IdProyecto = $this->getPost('idProyecto');
        $NombreProyecto = $this->getPost('nombreProyecto');
        $Descripcion = $this->getPost('descripcionProyecto');
        $Internet = $this->getPost('requiereInternet');
        $Electricidad = $this->getPost('requiereElectricidad');
        $EsInvestigacion = $this->getPost('esInvestigacion');
        $IdCarrera = $this->getPost('idCarrera');
        $IdAsignatura = $this->getPost('idAsignatura');

        if (
                $IdProyecto !== NULL &&
                $NombreProyecto !== NULL &&
                $Descripcion !== NULL &&
                $Internet !== NULL &&
                $Electricidad !== NULL &&
                $EsInvestigacion !== NULL &&
                $IdCarrera !== NULL &&
                $IdAsignatura !== NULL
        ) {
            $this->ProyectoEntry = $this->updateProyecto(
                    (int) $IdProyecto,
                    (string) $NombreProyecto,
                    (string) $Descripcion,
                    (int) $Internet,
                    (int) $Electricidad,
                    (int) $EsInvestigacion,
                    (int) $IdCarrera,
                    (int) $IdAsignatura
            );
        } else {
            $this->setVars([
                'error.code' => 1,
                'error.message' => 'No valid post body'
            ]);
        }
    }

    public function setUp() {
        $this->Proyectos = new Proyectos($this->Extended());
        $this->ProyectoEntry = new ProyectoEntry();
    }

    /**
     * 
     * @return Proyectos
     */
    private function getProyecto(): Proyectos {
        return $this->Proyectos;
    }

    /**
     * 
     * @param int $IdProyecto
     * @param string $NombreProyecto
     * @param string $Descripcion
     * @param int $Internet
     * @param int $Electricidad
     * @param int $EsInvestigacion
     * @param int $IdCarrera
     * @param int $IdAsignatura
     * @return ProyectoEntry
     */
    private function updateProyecto(int $IdProyecto, string $NombreProyecto, string $Descripcion, int $Internet, int $Electricidad, int $EsInvestigacion, int $IdCarrera, int $IdAsignatura): ProyectoEntry {
        $Controller = $this->getProyecto();

        $proyecto = $Controller->updateProyecto(
                $IdProyecto,
                $NombreProyecto,
                $Descripcion,
                $Internet,
                $Electricidad,
                $EsInvestigacion,
                $IdCarrera,
                $IdAsignatura
        );

        return $proyecto;
    }

}
