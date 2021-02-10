<?php

namespace NT5\Bulker\Modules\App;

use NT5\Bulker\Modules\App\Carreras\Database;
use NT5\Bulker\Modules\Extended\ExtendedExtended;
use NT5\Bulker\Modules\Extended;

/**
 * 
 */
class Carreras extends ExtendedExtended {

    use Database\getCarreraFromId,
        Database\getCarreraList,
        Database\getCarreraCount;

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);

        $this->Basics()->setLog("Nueva clase controladora de carreras creada");
    }

}
