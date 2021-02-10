<?php

namespace NT5\Bulker\Application\Api\Areas;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\Area;

/**
 * 
 */
class Invalid extends Area {

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);
    }

    public function initVars() {
        $this->setVars([
            'error.code' => 404,
            'error.message' => 'No valid API endpoint'
        ]);
    }

    public function CheckPost() {
        
    }

    public function setUp() {
        
    }

}
