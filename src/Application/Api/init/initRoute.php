<?php

namespace NT5\Bulker\Application\Api\init;

use NT5\Bulker\Application\Api\ApiRoute;
use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\Areas;

trait initRoute {

    /**
     * 
     * @return Extended
     */
    public abstract function getExtended();

    /**
     * 
     * @return ApiRoute
     */
    public abstract function getRoute();

    private function initRoute() {
        $Route = new ApiRoute('p', Areas\Invalid::class, $this->getExtended());
        $Ex = $Route->Extended();

        $Users = new ApiRoute('users', Areas\Users::class, $Ex);
        $Asignaturas = new ApiRoute('asignaturas', Areas\Asignaturas::class, $Ex);
        $Carreras = new ApiRoute('carreras', Areas\Carreras::class, $Ex);
        $Categorias = new ApiRoute('categorias', Areas\Categorias::class, $Ex);
        $Proyectos = new ApiRoute('proyectos', Areas\Proyectos::class, $Ex);
        $Ideas = new ApiRoute('ideas', Areas\ProyectosIdeas::class, $Ex);
        $Valoraciones = new ApiRoute('valoraciones', Areas\Valoraciones::class, $Ex);
        $Votacion = new ApiRoute('votacion', Areas\Votacion::class, $Ex);
        $Notificaciones = new ApiRoute('push', Areas\Notificaciones::class, $Ex);

        $Route
                ->addRoute(new ApiRoute('invalid', Areas\Invalid::class, $Ex))
                ->addRoute(new ApiRoute('info', Areas\Info::class, $Ex))
                ->addRoute(new ApiRoute('sqlinstall', Areas\SQLInstall::class, $Ex))
                ->addRoute($Users)
                ->addRoute($Asignaturas)
                ->addRoute($Carreras)
                ->addRoute($Categorias)
                ->addRoute($Proyectos)
                ->addRoute($Ideas)
                ->addRoute($Valoraciones)
                ->addRoute($Notificaciones)
                ->addRoute($Votacion);

        $Users
                ->addRoute(new ApiRoute('getSession', Areas\Users\getSession::class, $Ex))
                ->addRoute(new ApiRoute('getFromToken', Areas\Users\getFromToken::class, $Ex))
                ->addRoute(new ApiRoute('getListFromType', Areas\Users\getListFromType::class, $Ex))
                ->addRoute(new ApiRoute('getTokenList', Areas\Users\getTokenList::class, $Ex))
                ->addRoute(new ApiRoute('registerUser', Areas\Users\registerUser::class, $Ex))
                ->addRoute(new ApiRoute('removeFromId', Areas\Users\removeFromId::class, $Ex))
                ->addRoute(new ApiRoute('updateFullName', Areas\Users\updateFullName::class, $Ex))
                ->addRoute(new ApiRoute('getLogin', Areas\Users\getLogin::class, $Ex));

        $Asignaturas
                ->addRoute(new ApiRoute('getList', Areas\Asignaturas\getList::class, $Ex))
                ->addRoute(new ApiRoute('getFromCarreraNivel', Areas\Asignaturas\getFromCarreraNivel::class, $Ex))
                ->addRoute(new ApiRoute('getFromId', Areas\Asignaturas\getFromId::class, $Ex));

        $Carreras
                ->addRoute(new ApiRoute('getList', Areas\Carreras\getList::class, $Ex))
                ->addRoute(new ApiRoute('getFromId', Areas\Carreras\getFromId::class, $Ex));

        $Categorias
                ->addRoute(new ApiRoute('getList', Areas\Categorias\getList::class, $Ex))
                ->addRoute(new ApiRoute('getListFromUserId', Areas\Categorias\getListFromUserId::class, $Ex))
                ->addRoute(new ApiRoute('getFromId', Areas\Categorias\getFromId::class, $Ex));

        $Proyectos
                ->addRoute(new ApiRoute('getList', Areas\Proyectos\getList::class, $Ex))
                ->addRoute(new ApiRoute('getListFromUserId', Areas\Proyectos\getListFromUserId::class, $Ex))
                ->addRoute(new ApiRoute('getListFromCategoriaId', Areas\Proyectos\getListFromCategoriaId::class, $Ex))
                ->addRoute(new ApiRoute('getListFromCategoriaAndUser', Areas\Proyectos\getListFromCategoriaAndUser::class, $Ex))
                ->addRoute(new ApiRoute('registerProyecto', Areas\Proyectos\registerProyecto::class, $Ex))
                ->addRoute(new ApiRoute('removeFromId', Areas\Proyectos\removeFromId::class, $Ex))
                ->addRoute(new ApiRoute('updateProyecto', Areas\Proyectos\updateProyecto::class, $Ex))
                ->addRoute(new ApiRoute('likeProyecto', Areas\Proyectos\likeProyecto::class, $Ex))
                ->addRoute(new ApiRoute('uploadPhoto', Areas\Proyectos\uploadPhoto::class, $Ex))
                ->addRoute(new ApiRoute('getCSV', Areas\Proyectos\getCSV::class, $Ex))
                ->addRoute(new ApiRoute('getFromId', Areas\Proyectos\getFromId::class, $Ex));

        $Ideas
                ->addRoute(new ApiRoute('registerIdea', Areas\ProyectosIdeas\registerIdea::class, $Ex));

        $Valoraciones
                ->addRoute(new ApiRoute('registerValoracion', Areas\Valoraciones\registerValoracion::class, $Ex));

        $Votacion
                ->addRoute(new ApiRoute('getFromId', Areas\Votacion\getFromId::class, $Ex))
                ->addRoute(new ApiRoute('getListFromUserId', Areas\Votacion\getListFromUserId::class, $Ex))
                ->addRoute(new ApiRoute('getFromProyectoAndUserId', Areas\Votacion\getFromProyectoAndUserId::class, $Ex))
                ->addRoute(new ApiRoute('registerVotacion', Areas\Votacion\registerVotacion::class, $Ex))
                ->addRoute(new ApiRoute('getListFromUserId', Areas\Votacion\getListFromUserId::class, $Ex))
                ->addRoute(new ApiRoute('removeFromProyectoAndUserId', Areas\Votacion\removeFromProyectoAndUserId::class, $Ex))
                ->addRoute(new ApiRoute('getState', Areas\Votacion\getState::class, $Ex))
                ->addRoute(new ApiRoute('setState', Areas\Votacion\setState::class, $Ex))
                ->addRoute(new ApiRoute('getResultados', Areas\Votacion\getResultados::class, $Ex));

        $Notificaciones
                ->addRoute(new ApiRoute('sendToAll', Areas\Notificaciones\sendToAll::class, $Ex));

        $this->Route = $Route->init();
    }

}
