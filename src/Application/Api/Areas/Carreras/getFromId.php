<?php

namespace NT5\Bulker\Application\Api\Areas\Carreras;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\Area;
use NT5\Bulker\Modules\App\Carreras;

/**
 * 
 */
class getFromId extends Area {

    /**
     *
     * @var Carreras
     */
    private $Carreras;

    /**
     *
     * @var Carreras\CarreraEntry

     */
    private $CarrerasInfo;

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);
    }

    public function initVars() {
        $this->setVars([
            'carrera' => [
                'nombre' => $this->CarrerasInfo->getNombreCarrera(),
                'id' => $this->CarrerasInfo->getIdCarrera(),
            ]
        ]);
    }

    public function CheckPost() {
        $c = $this->Carreras;

        $post_id = filter_input(INPUT_POST, 'id');
        if ($post_id) {
            $carrera = $c->getCarreraFromId($post_id);
            if ($carrera->getIdCarrera() !== 0) {
                $this->CarrerasInfo = $carrera;
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
        $this->Carreras = new Carreras($this->Extended());
        $this->CarrerasInfo = new Carreras\CarreraEntry();
    }

}
