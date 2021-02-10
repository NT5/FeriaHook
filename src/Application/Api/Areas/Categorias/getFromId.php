<?php

namespace NT5\Bulker\Application\Api\Areas\Categorias;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\Area;
use NT5\Bulker\Modules\App\Categorias;

/**
 * 
 */
class getFromId extends Area {

    /**
     *
     * @var Categorias
     */
    private $Categorias;

    /**
     *
     * @var Categorias\CategoriaEntry

     */
    private $CategoriasInfo;

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);
    }

    public function initVars() {
        $this->setVars([
            'categoria' => [
                'nombre' => $this->CategoriasInfo->getNombreCategoria(),
                'id' => $this->CategoriasInfo->getIdCategoria(),
            ]
        ]);
    }

    public function CheckPost() {
        $c = $this->Categorias;

        $post_id = filter_input(INPUT_POST, 'id');
        if ($post_id) {
            $categoria = $c->getCategoriaFromId($post_id);
            if ($categoria->getIdCategoria() !== 0) {
                $this->CategoriasInfo = $categoria;
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
        $this->Categorias = new Categorias($this->Extended());
        $this->CategoriasInfo = new Categorias\CategoriaEntry();
    }

}
