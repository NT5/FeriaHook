<?php

namespace NT5\Bulker\Modules\App\Carreras;

/**
 * @todo Documentar
 */
class CarreraEntry {

    /**
     *
     * @var int
     */
    private $IdCarrera;

    /**
     *
     * @var string
     */
    private $CodCarrera;

    /**
     *
     * @var string
     */
    private $NombreCarrera;

    /**
     *
     * @var string
     */
    private $CreateAt;

    /**
     * 
     * @param int $IdCarrera
     * @param string $CodCarrera
     * @param string $NombreCarrera
     * @param string $CreateAt
     */
    public function __construct(int $IdCarrera = 0, string $CodCarrera = "No definida", string $NombreCarrera = "No definida", string $CreateAt = "0") {
        $this->IdCarrera = $IdCarrera;
        $this->CodCarrera = $CodCarrera;
        $this->NombreCarrera = $NombreCarrera;
        $this->CreateAt = $CreateAt;
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
    public function getCodCarrera(): string {
        return $this->CodCarrera;
    }

    /**
     * 
     * @return string
     */
    public function getNombreCarrera(): string {
        return $this->NombreCarrera;
    }

    /**
     * 
     * @return string
     */
    public function getCreateAt(): string {
        return $this->CreateAt;
    }

}
