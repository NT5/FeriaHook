<?php

namespace NT5\Bulker\Application\Api\Areas\Votacion;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\Area;
use NT5\Bulker\Modules\App\Votacion;
use NT5\Bulker\Modules\App\Proyectos;
use NT5\Bulker\Modules\Util\Functions;

/**
 * 
 */
class getResultados extends Area {

    /**
     *
     * @var Votacion
     */
    private $Controller;

    /**
     *
     * @var Proyectos
     */
    private $Proyectos;

    /**
     *
     * @var Votacion\VotacionEntry[]
     */
    private $List = [];

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);
    }

    public function initVars() {
        $list = [];
        $Sumas = [];

        $p = $this->Proyectos;

        foreach ($this->List as $entry) {
            $proyecto = $p->getProyectoFromId($entry->getIdProyecto());
            $categoria = $proyecto->getCategoria();

            $nombreCategoria = $categoria->getNombreCategoria();
            $nombreProyecto = $proyecto->getNombreProyecto();

            if (!array_key_exists($nombreCategoria, $Sumas)) {
                $Sumas[$nombreCategoria] = [];
            }
            if (!array_key_exists($nombreProyecto, $Sumas[$nombreCategoria])) {
                $Sumas[$nombreCategoria][$nombreProyecto] = [
                    "documento" => 0,
                    "documento1" => 0,
                    "documento2" => 0,
                    "documento3" => 0,
                    "documento4" => 0,
                    "pertinencia" => 0,
                    "pertinencia1" => 0,
                    "pertinencia2" => 0,
                    "pertinencia3" => 0,
                    "pertinencia4" => 0,
                    "creatividadIn" => 0,
                    "creatividadIn1" => 0,
                    "creatividadIn2" => 0,
                    "total" => 0,
                    "votos" => 0,
                    "proyecto" => $proyecto->getJson()
                ];
            }

            $Sumas[$nombreCategoria][$nombreProyecto]["documento"] += $entry->getTotalDocumento();
            $Sumas[$nombreCategoria][$nombreProyecto]["documento1"] += $entry->getDocumento_Score1();
            $Sumas[$nombreCategoria][$nombreProyecto]["documento2"] += $entry->getDocumento_Score2();
            $Sumas[$nombreCategoria][$nombreProyecto]["documento3"] += $entry->getDocumento_Score3();
            $Sumas[$nombreCategoria][$nombreProyecto]["documento4"] += $entry->getDocumento_Score4();

            $Sumas[$nombreCategoria][$nombreProyecto]["pertinencia"] += $entry->getTotalPertinencia();
            $Sumas[$nombreCategoria][$nombreProyecto]["pertinencia1"] += $entry->getPertinencia_Score1();
            $Sumas[$nombreCategoria][$nombreProyecto]["pertinencia2"] += $entry->getPertinencia_Score2();
            $Sumas[$nombreCategoria][$nombreProyecto]["pertinencia3"] += $entry->getPertinencia_Score3();
            $Sumas[$nombreCategoria][$nombreProyecto]["pertinencia4"] += $entry->getPertinencia_Score4();

            $Sumas[$nombreCategoria][$nombreProyecto]["creatividadIn"] += $entry->getTotalCreatividadInnovacion();
            $Sumas[$nombreCategoria][$nombreProyecto]["creatividadIn1"] += $entry->getCreatividad_Innovacion_Score1();
            $Sumas[$nombreCategoria][$nombreProyecto]["creatividadIn2"] += $entry->getCreatividad_Innovacion_Score2();

            $Sumas[$nombreCategoria][$nombreProyecto]["total"] += $entry->getTotal();
            $Sumas[$nombreCategoria][$nombreProyecto]["votos"] ++;

            $list[] = [
                "proyecto" => $proyecto->getJson(),
                "votacion" => $entry->getJson()
            ];
        }

        foreach ($Sumas as $key => $val) {
            $Sumas[$key] = Functions::array_orderby($val, 'total', SORT_DESC);
        }
        foreach ($Sumas as $key => $val) {
            $position = 1;
            foreach ($Sumas[$key] as $k => $v) {
                $Sumas[$key][$k]["position"] = $position;
                $position++;
            }
        }

        $this->setVars([
            'resultados' => $Sumas,
            'votaciones' => $list
        ]);
    }

    public function CheckPost() {
        $Controller = $this->Controller;
        $Categorias = $this->Proyectos->getCategoria()->getCategoriaList();

        foreach ($Categorias as $Categoria) {
            $categoria_id = $Categoria->getIdCategoria();

            $items = $Controller->getVotacionFromCategoriaId($categoria_id);

            $this->List = array_merge($items, $this->List);
        }
    }

    public function setUp() {
        $this->Controller = new Votacion($this->Extended());
        $this->Proyectos = new Proyectos($this->Extended());
    }

}
