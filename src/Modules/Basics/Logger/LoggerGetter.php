<?php

namespace NT5\Bulker\Modules\Basics\Logger;

trait LoggerGetter {

    /**
     * Alamacena todos los registros
     * @var \NT5\Bulker\Modules\Basics\Logger\Log[] 
     */
    protected $Logs = [];

    /**
     * Regresa un arreglo con todos los registros que posee la instancia
     * @return \NT5\Bulker\Modules\Basics\Logger\Log[] Lista de registros
     */
    public function getLogs() {
        return $this->Logs;
    }

    /**
     * Regresa los registros del area espeficiada
     * @param string $class Lugar donde se guardo el registro
     * @param int $index Index del log dentro del array
     * @return array|FALSE Arreglo con todos los registros del area espeficificada
     * o <b>FALSE</b> si el area no existe en los registros
     */
    public function getLog($class, $index = NULL) {
        return (array_key_exists($class, $this->getLogs()) ? ($index === NULL ? $this->getLogs()[$class] : $this->getLogs()[$class][$index] ) : FALSE);
    }

    /**
     * 
     * @return int
     */
    public function getLogCount() {
        return array_sum(array_map("count", $this->getLogs()));
    }

}
