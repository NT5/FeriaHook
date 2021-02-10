<?php

namespace NT5\Bulker\Application\Api\Areas;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\Area;

/**
 * 
 */
class CategoriasAsignadas extends Area {

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);
    }

    public function initVars() {
        $this->setVars([
            'api.area' => 'Categorias Asignadas',
            'api.version' => '0.0.1b',
            'api.description' => 'Manejo de Categorias por usuarios'
        ]);
    }

    public function CheckPost() {
        
    }

    public function setUp() {
        
    }

}
