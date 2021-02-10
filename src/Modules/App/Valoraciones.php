<?php

namespace NT5\Bulker\Modules\App;

use NT5\Bulker\Modules\App\Valoraciones\Database;
use NT5\Bulker\Modules\Extended\ExtendedExtended;
use NT5\Bulker\Modules\Extended;

/**
 * 
 */
class Valoraciones extends ExtendedExtended {

    use Database\registreValoracion;

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);

        $this->Basics()->setLog("Nueva clase controladora de Valoraciones creada");
    }

}
