<?php

namespace NT5\Bulker\Application\Api\Areas\Notificaciones;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Modules\App\Notificaciones;
use NT5\Bulker\Application\Api\LoggedArea;

/**
 * 
 */
class sendToAll extends LoggedArea {

    /**
     *
     * @var Notificaciones
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

        $title = ($this->getPost('title') !== NULL ? $this->getPost('title') : "Title");
        $text = ($this->getPost('text') !== NULL ? $this->getPost('text') : "text");

        $C = $this->Controller;
        $reg = $C->sendToAll($title, $text);
        if ($reg) {
            $this->setVars([
                'success' => true,
                'response' => $reg
            ]);
        } else {
            $this->setVars([
                'error.code' => 2,
                'error.message' => 'No se pudo registrar tu notificacion'
            ]);
        }
    }

    public function setUp() {
        $this->Controller = new Notificaciones($this->Extended());
    }

}
