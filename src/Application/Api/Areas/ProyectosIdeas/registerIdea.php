<?php

namespace NT5\Bulker\Application\Api\Areas\ProyectosIdeas;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Modules\App\ProyectosIdeas;
use NT5\Bulker\Modules\App\ProyectosIdeas\ProyectosIdeasEntry;
use NT5\Bulker\Application\Api\Area;

/**
 * 
 */
class registerIdea extends Area {

    /**
     *
     * @var ProyectosIdeas
     */
    private $Controller;

    /**
     *
     * @var ProyectosIdeasEntry
     */
    private $Entry;

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);
    }

    public function initVars() {
        $this->setVars([
            'idea' => $this->Entry->getJson()
        ]);
    }

    public function CheckPost() {

        $NombreCreador = ($this->getPost('creador') !== NULL ? $this->getPost('creador') : "Anónimo");
        $TelefonoCreador = ($this->getPost('telefono') !== NULL ? $this->getPost('telefono') : "Anónimo");
        $CorreoCreador = ($this->getPost('correo') !== NULL ? $this->getPost('correo') : "Anónimo");
        $DescripcionProyecto = $this->getPost('descripcion');

        if ($DescripcionProyecto !== NULL) {
            $this->Entry = $this->registerIdea($NombreCreador, $TelefonoCreador, $CorreoCreador, $DescripcionProyecto);
        } else {
            $this->setVars([
                'error.code' => 1,
                'error.message' => 'No valid post body'
            ]);
        }
    }

    public function setUp() {
        $this->Controller = new ProyectosIdeas($this->Extended());
        $this->Entry = new ProyectosIdeasEntry();
    }

    /**
     * 
     * @param string $NombreCreador
     * @param string $TelefonoCreador
     * @param string $CorreoCreador
     * @param string $DescripcionProyecto
     * @return ProyectosIdeasEntry
     */
    private function registerIdea(string $NombreCreador, string $TelefonoCreador, string $CorreoCreador, string $DescripcionProyecto): ProyectosIdeasEntry {
        $proyecto = $this->Controller->registreIdeaProyecto($NombreCreador, $TelefonoCreador, $CorreoCreador, $DescripcionProyecto);

        return $proyecto;
    }

}
