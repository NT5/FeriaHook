<?php

namespace NT5\Bulker\Modules\App;

use NT5\Bulker\Modules\App\Asignaturas\Database;
use NT5\Bulker\Modules\Extended\ExtendedExtended;
use NT5\Bulker\Modules\Extended;

/**
 * 
 */
class Asignaturas extends ExtendedExtended {

    use Database\getAsignaturaFromId,
        Database\getAsignaturaFromCarreraNivel,
        Database\getAsignaturaList,
        Database\getAsignaturaCount;

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);

        $this->Basics()->setLog("Nueva clase controladora de asignaturas creada");
    }

}
