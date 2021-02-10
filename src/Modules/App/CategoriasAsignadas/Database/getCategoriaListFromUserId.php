<?php

namespace NT5\Bulker\Modules\App\CategoriasAsignadas\Database;

use NT5\Bulker\Modules\App;
use NT5\Bulker\Modules\App\Categorias\CategoriaEntry;
use NT5\Bulker\Modules\Extended;

/**
 * 
 */
trait getCategoriaListFromUserId {

    /**
     * @return Extended
     */
    public abstract function Extended();

    /**
     * 
     * @return App\Categorias
     */
    public abstract function getCategorias(): App\Categorias;

    /**
     * 
     * @param int $user_id
     * @return CategoriaEntry[]
     */
    public function getCategoriaListFromUserId(int $user_id) {

        $db = $this->Extended()->Database();
        $Categorias = $this->getCategorias();

        $CategoriaEntryId = NULL;
        $EntryList = [];

        $stmt = $db->prepare("SELECT IdCategoria FROM CategoriasAsignadas WHERE IdUser = ?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $stmt->bind_result($CategoriaEntryId);
        $stmt->store_result();
        while ($stmt->fetch()) {
            $CategoriaEntry = $Categorias->getCategoriaFromId($CategoriaEntryId);
            $EntryList[] = $CategoriaEntry;
        }
        $stmt->free_result();
        $stmt->close();

        return $EntryList;
    }

}
