<?php

namespace NT5\Bulker\Application\Api\Areas\Votacion;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\Area;
use NT5\Bulker\Modules\App\Votacion;

/**
 * 
 */
class getFromProyectoAndUserId extends Area {

    /**
     *
     * @var Votacion
     */
    private $Controller;

    /**
     *
     * @var Votacion\VotacionEntry

     */
    private $Info;

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);
    }

    public function initVars() {
        $this->setVars([
            'votacion' => $this->Info->getJson()
        ]);
    }

    public function CheckPost() {
        $Controller = $this->Controller;

        $proyecto_id = filter_input(INPUT_POST, 'proyecto_id');
        $user_id = filter_input(INPUT_POST, 'user_id');

        if ($proyecto_id != NULL && $user_id) {
            $item = $Controller->getVotacionFromProyectoAndUserId($proyecto_id, $user_id);
            if ($item->getIdVoto() !== 0) {
                $this->Info = $item;
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
        $this->Controller = new Votacion($this->Extended());
        $this->Info = new Votacion\VotacionEntry();
    }

}
