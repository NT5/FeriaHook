<?php

namespace NT5\Bulker\Application\Api\Areas\Asignaturas;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\Area;
use NT5\Bulker\Modules\App\Asignaturas;

/**
 * 
 */
class getList extends Area {

    /**
     *
     * @var Asignaturas
     */
    private $Asignaturas;

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);
    }

    public function initVars() {
        $list = [];
        $db = $this->Asignaturas->getAsignaturaList();

        foreach ($db as $entry) {
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
        
    }

    public function setUp() {
        $this->Asignaturas = new Asignaturas($this->Extended());
    }

}
