<?php

namespace NT5\Bulker\Modules\Extended\Database;

use NT5\Bulker\Modules\Basics;
use NT5\Bulker\Modules\Extended\Database\DatabaseConfig;

/**
 * @todo Documendar
 * Instancia abstracta usada para almacenar y cargar
 * datos de configuración de la base de datos
 */
class DatabaseConfig extends Basics\BasicsExtend implements DatabaseConfig\DatabaseConfigInterface {

    use DatabaseConfig\saveToIni,
        DatabaseConfig\fromIniFile;

    /**
     * @var string Dirección del servidor de la base de datos
     */
    private $server;

    /**
     * @var string Nombre de usuario de la base de datos 
     */
    private $username;

    /**
     * @var string Contraseña de conexion 
     */
    private $password;

    /**
     * @var string Base de datos que se usara
     */
    private $database;

    /**
     * Regresa instancia de configuración de la base de datos
     * @param string $server Dirección del servidor de la base de datos
     * @param string $username Nombre de usuario de la base de datos
     * @param string $password Contraseña de conexion
     * @param string $database Base de datos que se usara
     * @param Basics $Basics
     */
    public function __construct($server = NULL, $username = NULL, $password = NULL, $database = NULL, Basics $Basics = NULL) {
        parent::__construct($Basics);

        $this->server = ($server) ?: "localhost";
        $this->username = ($username) ?: "default";
        $this->password = ($password) ?: "default";
        $this->database = ($database) ?: "uml_sao";

        $this->Basics()->setLog("Nueva instancia de configuración de base de datos creada");
    }

    /**
     * 
     * @return string
     */
    public function getServer() {
        return $this->server;
    }

    /**
     * 
     * @return string
     */
    public function getUserName() {
        return $this->username;
    }

    /**
     * 
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * 
     * @return string
     */
    public function getDatabase() {
        return $this->database;
    }

    /**
     * 
     * @param string $server
     * @return string
     */
    public function setServer($server = 'localhost') {
        $this->server = $server;
        return $server;
    }

    /**
     * 
     * @param string $username
     * @return string
     */
    public function setUserName($username = 'default') {
        $this->username = $username;
        return $username;
    }

    /**
     * 
     * @param string $password
     * @return string
     */
    public function setPassword($password = 'default') {
        $this->password = $password;
        return $password;
    }

    /**
     * 
     * @param string $database
     * @return string
     */
    public function setDatabase($database = 'uml_sao') {
        $this->database = $database;
        return $database;
    }

}
