<?php

namespace NT5\Bulker\Application\Api\Areas\Categorias;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\Area;
use NT5\Bulker\Modules\App\Categorias;

/**
 * 
 */
class getList extends Area {

    /**
     *
     * @var Categorias
     */
    private $Categorias;

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);
    }

    public function initVars() {

        $list = [];
        $db = $this->Categorias->getCategoriaList();

        foreach ($db as $entry) {
            $list[] = [
                'id' => $entry->getIdCategoria(),
                'nombre' => $entry->getNombreCategoria()
            ];
        }

        $this->setVars([
            'categorias' => $list
        ]);
    }

    public function CheckPost() {
        
    }

    public function setUp() {
        $this->Categorias = new Categorias($this->Extended());
    }

}
