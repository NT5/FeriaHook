<?php

namespace NT5\Bulker\Application\Api\Areas\Proyectos;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\Area;
use NT5\Bulker\Modules\App\Proyectos;

/**
 * 
 */
class getList extends Area {

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

        $list = [];
        $db = $this->Proyectos->getProyectoList();

        foreach ($db as $entry) {
            $list[] = $entry->getJson();
        }

        $this->setVars([
            'proyectos' => $list
        ]);
    }

    public function CheckPost() {
        
    }

    public function setUp() {
        $this->Proyectos = new Proyectos($this->Extended());
    }

}
