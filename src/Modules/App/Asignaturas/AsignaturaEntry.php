<?php

namespace NT5\Bulker\Modules\App\Asignaturas;

/**
 * @todo Documentar
 */
class AsignaturaEntry {

    /**
     *
     * @var int
     */
    private $IdAsignatura;

    /**
     *
     * @var int
     */
    private $IdCarrera;

    /**
     *
     * @var string
     */
    private $CodAsignatura;

    /**
     *
     * @var string
     */
    private $NombreAsignatura;

    /**
     *
     * @var int
     */
    private $Nivel;

    /**
     *
     * @var string
     */
    private $CreateAt;

    /**
     * 
     * @param int $IdAsignatura
     * @param int $IdCarrera
     * @param string $CodAsignatura
     * @param string $NombreAsignatura
     * @param int $Nivel
     * @param string $CreateAt
     */
    public function __construct(int $IdAsignatura = 0, int $IdCarrera = 0, string $CodAsignatura = "No definido", string $NombreAsignatura = "No definida", int $Nivel = 0, string $CreateAt = "0") {
        $this->IdAsignatura = $IdAsignatura;
        $this->IdCarrera = $IdCarrera;
        $this->CodAsignatura = $CodAsignatura;
        $this->NombreAsignatura = $NombreAsignatura;
        $this->Nivel = $Nivel;
        $this->CreateAt = $CreateAt;
    }

    /**
     * 
     * @return int
     */
    public function getIdAsignatura(): int {
        return $this->IdAsignatura;
    }

    /**
     * 
     * @return int
     */
    public function getIdCarrera(): int {
        return $this->IdCarrera;
    }

    /**
     * 
     * @return string
     */
    public function getCodAsignatura(): string {
        return $this->CodAsignatura;
    }

    /**
     * 
     * @return string
     */
    public function getNombreAsignatura(): string {
        return $this->NombreAsignatura;
    }

    /**
     * 
     * @return int
     */
    public function getNivel(): int {
        return $this->Nivel;
    }

    /**
     * 
     * @return string
     */
    public function getCreateAt(): string {
        return $this->CreateAt;
    }

}
