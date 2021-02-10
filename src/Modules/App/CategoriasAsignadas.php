<?php

namespace NT5\Bulker\Modules\App;

use NT5\Bulker\Modules\App;
use NT5\Bulker\Modules\App\CategoriasAsignadas\Database;
use NT5\Bulker\Modules\Extended\ExtendedExtended;
use NT5\Bulker\Modules\Extended;

/**
 * 
 */
class CategoriasAsignadas extends ExtendedExtended {

    use Database\getCategoriaListFromUserId,
        Database\registreCategoriaAsignada;

    /**
     *
     * @var App\Categorias
     */
    private $Categorias;

    /**
     *
     * @var App\Users
     */
    private $Users;

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);

        $this->Categorias = new App\Categorias($Extended);
        $this->Users = new App\Users($Extended);

        $this->Basics()->setLog("Nueva clase controladora de CategoriasAsignadas creada");
    }

    /**
     * 
     * @return App\Categorias
     */
    public function getCategorias(): App\Categorias {
        return $this->Categorias;
    }

    /**
     * 
     * @return App\Users
     */
    public function getUsers(): App\Users {
        return $this->Users;
    }

}
