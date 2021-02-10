<?php

namespace NT5\Bulker\Application\Api\Areas\Asignaturas;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\Area;
use NT5\Bulker\Modules\App\Asignaturas;

/**
 * 
 */
class getFromCarreraNivel extends Area {

    /**
     *
     * @var Asignaturas
     */
    private $Asignaturas;

    /**
     *
     * @var int
     */
    private $CarreraId;

    /**
     *
     * @var int
     */
    private $CarreraNivel;

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);
    }

    public function initVars() {
        $CarreraNivel = $this->CarreraNivel;
        $CarreraId = $this->CarreraId;
        $list = [];
        $data = $this->Asignaturas->getAsignaturaFromCarreraNivel($CarreraId, $CarreraNivel);

        foreach ($data as $entry) {
            $list[] = [
                'id' => $entry->getIdAsignatura(),
                'codigo' => $entry->getCodAsignatura(),
                'id_carrera' => $entry->getIdCarrera(),
                'nivel' => $entry->getNivel(),
                'nombre' => $entry->getNombreAsignatura(),
            ];
        }

        $this->setVars([
            'asignaturas' => $list
        ]);
    }

    public function CheckPost() {
        $carrera_nivel = filter_input(INPUT_POST, 'carrera_nivel');
        $carrera_id = filter_input(INPUT_POST, 'carrera_id');

        if ($carrera_nivel && $carrera_id) {
            $this->CarreraId = $carrera_id;
            $this->CarreraNivel = $carrera_nivel;
        } else {
            $this->setVars([
                'error.code' => 1,
                'error.message' => 'No post valid post body, sending dummy data'
            ]);
        }
    }

    public function setUp() {
        $this->Asignaturas = new Asignaturas($this->Extended());
        $this->CarreraId = 1;
        $this->CarreraNivel = 1;
    }

}
