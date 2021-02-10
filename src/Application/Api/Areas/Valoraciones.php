<?php

namespace NT5\Bulker\Application\Api\Areas;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\Area;

/**
 * 
 */
class Valoraciones extends Area {

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);
    }

    public function initVars() {
        $this->setVars([
            'api.area' => 'Valoraciones',
            'api.version' => '0.0.1b',
            'api.description' => 'Manejo de Valoraciones'
        ]);
    }

    public function CheckPost() {
        
    }

    public function setUp() {
        
    }

}
