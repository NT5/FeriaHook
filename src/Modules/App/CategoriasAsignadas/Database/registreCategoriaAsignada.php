<?php

namespace NT5\Bulker\Modules\App\CategoriasAsignadas\Database;

use NT5\Bulker\Modules\App\CategoriasAsignadas\CategoriaAndUserEntry;
use NT5\Bulker\Modules\Extended;

/**
 * 
 */
trait registreCategoriaAsignada {

    /**
     * @return Extended
     */
    public abstract function Extended();

    /**
     * 
     * @param int $user_id
     * @return CategoriaAndUserEntry[]
     */
    public abstract function getCategoriaListFromUserId(int $user_id);

    /**
     * 
     * @param int $user_id
     * @param int $categoria_id
     * @return CategoriaAndUserEntry[]
     */
    public function registreCategoriaAsignada(int $user_id, int $categoria_id) {

        $db = $this->Extended()->Database();

        $stmt = $db->prepare("INSERT INTO CategoriasAsignadas (IdUser, IdCategoria) VALUES(?, ?)");
        $stmt->bind_param('ii', $user_id, $categoria_id);
        $stmt->execute();

        if ($stmt->errno) {
            return [new CategoriaAndUserEntry(0, 0)];
        } else {
            return $this->getCategoriaListFromUserId($user_id);
        }
    }

}
