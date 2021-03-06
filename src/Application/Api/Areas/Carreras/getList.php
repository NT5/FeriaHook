<?php

namespace NT5\Bulker\Application\Api\Areas\Carreras;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\Area;
use NT5\Bulker\Modules\App\Carreras;

/**
 * 
 */
class getList extends Area {

    /**
     *
     * @var Carreras
     */
    private $Carreras;

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);
    }

    public function initVars() {

        $list = [];
        $db = $this->Carreras->getCarreraList();

        foreach ($db as $entry) {
            $list[] = [
                'id' => $entry->getIdCarrera(),
                'nombre' => $entry->getNombreCarrera()
            ];
        }

        $this->setVars([
            'carreras' => $list
        ]);
    }

    public function CheckPost() {
        
    }

    public function setUp() {
        $this->Carreras = new Carreras($this->Extended());
    }

}
