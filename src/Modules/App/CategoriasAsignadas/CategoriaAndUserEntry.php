<?php

namespace NT5\Bulker\Modules\App\CategoriasAsignadas;

use NT5\Bulker\Modules\App\Categorias\CategoriaEntry;
use NT5\Bulker\Modules\App\Users\UserEntry;

class CategoriaAndUserEntry {

    /**
     *
     * @var CategoriaEntry
     */
    private $CategoriaEntry;

    /**
     *
     * @var UserEntry
     */
    private $UserEntry;

    /**
     * 
     * @param CategoriaEntry $CategoriaEntry
     * @param UserEntry $UserEntry
     */
    public function __construct(CategoriaEntry $CategoriaEntry, UserEntry $UserEntry) {
        $this->CategoriaEntry = $CategoriaEntry;
        $this->UserEntry = $UserEntry;
    }

    /**
     * 
     * @return CategoriaEntry
     */
    public function getCategoriaEntry(): CategoriaEntry {
        return $this->CategoriaEntry;
    }

    /**
     * 
     * @return UserEntry
     */
    public function getUserEntry(): UserEntry {
        return $this->UserEntry;
    }

}
