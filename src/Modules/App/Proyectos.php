<?php

namespace NT5\Bulker\Modules\App;

use NT5\Bulker\Modules\App\Proyectos\Database;
use NT5\Bulker\Modules\Extended\ExtendedExtended;
use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Modules\App;

/**
 * 
 */
class Proyectos extends ExtendedExtended {

    use Database\getProyectoFromId,
        Database\registreProyecto,
        Database\updateProyecto,
        Database\likeProyectoFromId,
        Database\dislikeProyectoFromId,
        Database\getProyectoList,
        Database\getProyectoListFromUserId,
        Database\getProyectoListFromCategoriaId,
        Database\getProyectoListFromCategoriaAndUser,
        Database\removeProyectoFromId;

    /**
     *
     * @var App\Users
     */
    private $User;

    /**
     *
     * @var App\Carreras
     */
    private $Carrera;

    /**
     *
     * @var App\Asignaturas
     */
    private $Asignatura;

    /**
     *
     * @var App\Categorias
     */
    private $Categoria;

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);
        $this->User = new App\Users($Extended);
        $this->Carrera = new App\Carreras($Extended);
        $this->Asignatura = new App\Asignaturas($Extended);
        $this->Categoria = new App\Categorias($Extended);

        $this->Basics()->setLog("Nueva clase controladora de proyectos creada");
    }

    /**
     * 
     * @return \NT5\Bulker\Modules\App\Users
     */
    public function getUser(): App\Users {
        return $this->User;
    }

    /**
     * 
     * @return \NT5\Bulker\Modules\App\Carreras
     */
    public function getCarrera(): App\Carreras {
        return $this->Carrera;
    }

    /**
     * 
     * @return \NT5\Bulker\Modules\App\Asignaturas
     */
    public function getAsignatura(): App\Asignaturas {
        return $this->Asignatura;
    }

    /**
     * 
     * @return \NT5\Bulker\Modules\App\Categorias
     */
    public function getCategoria(): App\Categorias {
        return $this->Categoria;
    }

}
