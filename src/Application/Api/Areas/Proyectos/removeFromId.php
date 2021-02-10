<?php

namespace NT5\Bulker\Application\Api\Areas\Proyectos;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\LoggedArea;
use NT5\Bulker\Modules\App\Proyectos;

/**
 * 
 */
class removeFromId extends LoggedArea {

    /**
     *
     * @var Proyectos
     */
    private $Proyectos;

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
        $a = $this->Proyectos;
        $type = $this->getUser()->getUserType();
        if ($type === 3 || $type === 2) {
            $post_id = $this->getPost('id');
            if ($post_id !== NULL) {
                $a->removeProyectoFromId($post_id);
                $this->setVars([
                    'success' => true,
                    'message' => 'Se borro el proyecto id: ' . $post_id
                ]);
            } else {
                $this->setVars([
                    'error.code' => 1,
                    'error.message' => 'No post id variable'
                ]);
            }
        } else {
            $this->setVars([
                'error.code' => 3,
                'error.message' => 'No admin user'
            ]);
        }
    }

    public function setUp() {
        $this->Proyectos = new Proyectos($this->Extended());
    }

}
