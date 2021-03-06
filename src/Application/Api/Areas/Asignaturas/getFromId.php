<?php

namespace NT5\Bulker\Application\Api\Areas\Asignaturas;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\Area;
use NT5\Bulker\Modules\App\Asignaturas;

/**
 * 
 */
class getFromId extends Area {

    /**
     *
     * @var Asignaturas
     */
    private $Asignaturas;

    /**
     *
     * @var Asignaturas\AsignaturaEntry

     */
    private $AsignaturaInfo;

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);
    }

    public function initVars() {
        $this->setVars([
            'asignatura' => [
                'id' => $this->AsignaturaInfo->getIdAsignatura(),
                'codigo' => $this->AsignaturaInfo->getCodAsignatura(),
                'id_carrera' => $this->AsignaturaInfo->getIdCarrera(),
                'nivel' => $this->AsignaturaInfo->getNivel(),
                'nombre' => $this->AsignaturaInfo->getNombreAsignatura(),
            ]
        ]);
    }

    public function CheckPost() {
        $a = $this->Asignaturas;

        $post_id = filter_input(INPUT_POST, 'id');
        if ($post_id) {
            $asignatura = $a->getAsignaturaFromId($post_id);
            if ($asignatura->getIdAsignatura() !== 0) {
                $this->AsignaturaInfo = $asignatura;
            } else {
                $this->setVars([
                    'error.code' => 2,
                    'error.message' => 'No id found'
                ]);
            }
        } else {
            $this->setVars([
                'error.code' => 1,
                'error.message' => 'No post id variable'
            ]);
        }
    }

    public function setUp() {
        $this->Asignaturas = new Asignaturas($this->Extended());
        $this->AsignaturaInfo = new Asignaturas\AsignaturaEntry();
    }

}
