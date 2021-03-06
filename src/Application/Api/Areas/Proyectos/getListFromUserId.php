<?php

namespace NT5\Bulker\Application\Api\Areas\Proyectos;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\Area;
use NT5\Bulker\Modules\App\Proyectos;

/**
 * 
 */
class getListFromUserId extends Area {

    /**
     *
     * @var Proyectos
     */
    private $Proyectos;

    /**
     *
     * @var ProyectoEntry[]
     */
    private $ProyectosList = [];

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);
    }

    public function initVars() {
        $list = [];
        foreach ($this->ProyectosList as $entry) {
            $list[] = $entry->getJson();
        }
        $this->setVars([
            'proyectos' => $list
        ]);
    }

    public function CheckPost() {
        $a = $this->Proyectos;

        $post_id = filter_input(INPUT_POST, 'user_id');
        if ($post_id) {
            $proyectos = $a->getProyectoListFromUserId($post_id);
            if (count($proyectos) > 0) {
                $this->ProyectosList = $proyectos;
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
        $this->Proyectos = new Proyectos($this->Extended());
    }

}
