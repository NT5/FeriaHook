<?php

namespace NT5\Bulker\Application\Api\Areas\Valoraciones;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Modules\App\Valoraciones;
use NT5\Bulker\Application\Api\Area;
use NT5\Bulker\Modules\Util\Functions;

/**
 * 
 */
class registerValoracion extends Area {

    /**
     *
     * @var Valoraciones
     */
    private $Controller;

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);
    }

    public function initVars() {
        
    }

    public function CheckPost() {

        $UUID = ($this->getPost('uuid') !== NULL ? $this->getPost('uuid') : "Anónimo");
        $Score = ($this->getPost('score') !== NULL ? $this->getPost('score') : "0");

        $C = $this->Controller;
        $reg = $C->registreValoracion($Score, $UUID);
        if ($reg) {
            $this->setVars([
                'success' => true,
                'message' => 'Se añadio tu valoracion'
            ]);
        } else {
            $this->setVars([
                'error.code' => 2,
                'error.message' => 'No se pudo registrar tu valoracion'
            ]);
        }
    }

    public function setUp() {
        $this->Controller = new Valoraciones($this->Extended());
    }

}
