<?php

namespace NT5\Bulker\Modules\App\Valoraciones\Database;

use NT5\Bulker\Modules\Extended;

/**
 * 
 */
trait registreValoracion {

    /**
     * @return Extended
     */
    public abstract function Extended();

    /**
     * 
     * @param float $Score
     * @param string $UUID
     * @return boolean
     */
    public function registreValoracion(float $Score, string $UUID) {

        $db = $this->Extended()->Database();

        $stmt = $db->prepare("INSERT INTO Valoraciones (Score, UUID) VALUES(?, ?)");

        $stmt->bind_param('ds', $Score, $UUID);
        $stmt->execute();

        if ($stmt->errno) {
            return false;
        }
        return true;
    }

}
