<?php

namespace NT5\Bulker\Application\Api\Areas\Votacion;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\LoggedArea;
use NT5\Bulker\Modules\App\Votacion;

/**
 * 
 */
class removeFromProyectoAndUserId extends LoggedArea {

    /**
     *
     * @var Votacion
     */
    private $Controller;

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);
    }

    public function initVars() {
        
    }

    public function CheckPost() {
        $Controller = $this->Controller;

        $proyecto_id = $this->getPost('proyecto_id');
        $user_id = $this->getPost('user_id');

        if ($proyecto_id != NULL && $user_id != NULL) {
            $deleted = $Controller->removeVotacionFromProyectoAndUserId($proyecto_id, $user_id);
            if ($deleted) {
                $this->setVars([
                    'success' => true,
                    'message' => 'Se borro la votacion del proyecto ' . $proyecto_id . ' usuario ' . $user_id
                ]);
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
    }

}
