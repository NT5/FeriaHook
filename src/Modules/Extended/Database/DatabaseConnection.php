<?php

namespace NT5\Bulker\Modules\Extended\Database;

use NT5\Bulker\Modules\Basics;
use NT5\Bulker\Modules\Basics\Error;
use NT5\Bulker\Modules\Extended\Database;

/**
 * @todo Documentar
 * Clase controladora de la conexión MySQLi
 */
class DatabaseConnection extends Basics\BasicsExtend {

    /**
     * Instancia de configuración 
     * @var Database\DatabaseConfig
     */
    private $Config;

    /**
     * Objecto MySQLi
     * @var \mysqli 
     */
    private $MySQLi;

    /**
     * Regresa instancia de conexión MySQLi además de la instancia de configuración
     * @param Database\DatabaseConfig $Config     
     * @param boolean $Connect
     * @param Basics $Basics
     */
    public function __construct(Database\DatabaseConfig $Config = NULL, $Connect = TRUE, Basics $Basics = NULL) {
        parent::__construct($Basics);

        $this->Config = ($Config) ?: new Database\DatabaseConfig(NULL, NULL, NULL, NULL, $this->Basics());

        $this->Basics()->setLog("Nueva instancia de conexión de base de datos creada");

        if ($Connect) {
            $this->connect();
        }
    }

    /**
     * Función que intenta crear instancia MySQLi con la configuración asignada
     * @return Database\Connection
     */
    public function connect() {
        $this->Basics()->setLog("Intentando crear instancia de MySQLi...");
        $Config = $this->getConfig();

        $MySQLi = @new \mysqli(
                $Config->getServer(), $Config->getUserName(), $Config->getPassword(), $Config->getDatabase()
        );

        if ($MySQLi->connect_errno) {
            $this->Basics()->addError(Error\ErrorCodes::CANT_CONNECT_MYSQLI_LINK);
            $this->Basics()->setLog("No se pudo crear instancia MySQLi Error: %s (%s)", $MySQLi->connect_errno, $MySQLi->connect_error);
            $this->MySQLi = NULL;
        } else {
            $this->Basics()->setLog("Conexion MySQLi creada correctamente");
            $this->MySQLi = $MySQLi;
        }
        return $this;
    }

    /**
     * Regresa Objecto MySQLi
     * @return \mysqli|NULL Instancia <b>MySQLi</b> proporcionada por PHP NULL Si no esata conectado a la base de datos
     */
    public function getMySQLi() {
        return ($this->MySQLi !== NULL && !$this->MySQLi->connect_errno ? $this->MySQLi : NULL);
    }

    /**
     * Regresa instancia de configuración usada en la conexion de la base de datos
     * @return Database\DatabaseConfig
     */
    public function getConfig() {
        return $this->Config;
    }

}
