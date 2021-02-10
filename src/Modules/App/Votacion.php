<?php

namespace NT5\Bulker\Modules\App;

use NT5\Bulker\Modules\App\Votacion\Database;
use NT5\Bulker\Modules\Extended\ExtendedExtended;
use NT5\Bulker\Modules\Extended;

/**
 * 
 */
class Votacion extends ExtendedExtended {

    use Database\getVotacionFromId,
        Database\getVotacionFromUserId,
        Database\getVotacionFromProyectoId,
        Database\getVotacionFromCategoriaId,
        Database\getVotacionFromProyectoAndUserId,
        Database\getVotacionState,
        Database\setVotacionStateActive,
        Database\setVotacionStateDisable,
        Database\removeVotacionFromProyectoAndUserId,
        Database\registreVotacion;

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);

        $this->Basics()->setLog("Nueva clase controladora de proyectos creada");
    }

}
