<?php

namespace NT5\Bulker\Modules\App;

use NT5\Bulker\Modules\App\Categorias\Database;
use NT5\Bulker\Modules\Extended\ExtendedExtended;
use NT5\Bulker\Modules\Extended;

/**
 * 
 */
class Categorias extends ExtendedExtended {

    use Database\getCategoriaFromId,
        Database\getCategoriaList;

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);

        $this->Basics()->setLog("Nueva clase controladora de categorias creada");
    }

}
