<?php

namespace NT5\Bulker\Application\Api\Areas\Votacion;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\Area;
use NT5\Bulker\Modules\App\Votacion;

/**
 * 
 */
class getState extends Area {

    /**
     *
     * @var Votacion
     */
    private $Controller;

    /**
     *
     * @var bool
     */
    private $Info = false;

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);
    }

    public function initVars() {
        $this->setVars([
            'votacion.release' => $this->Info
        ]);
    }

    public function CheckPost() {
        $Controller = $this->Controller;

        $state = $Controller->getVotacionState();
        $this->Info = $state;
    }

    public function setUp() {
        $this->Controller = new Votacion($this->Extended());
    }

}
