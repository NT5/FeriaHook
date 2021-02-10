<?php

namespace NT5\Bulker\Modules\Extended\Database\DatabaseConfig;

use NT5\Bulker\Modules;

interface DatabaseConfigInterface {

    /**
     * 
     * @return Modules\Basics
     */
    public function Basics();

    /**
     * 
     * @return string
     */
    public function getServer();

    /**
     * 
     * @return string
     */
    public function getUserName();

    /**
     * 
     * @return string
     */
    public function getPassword();

    /**
     * 
     * @return string
     */
    public function getDatabase();

    /**
     * 
     * @param string $server
     */
    public function setServer($server = 'localhost');

    /**
     * 
     * @param string $username
     */
    public function setUserName($username = 'default');

    /**
     * 
     * @param string $password
     */
    public function setPassword($password = 'default');

    /**
     * 
     * @param string $database
     */
    public function setDatabase($database = 'uml_sao');

    /**
     * Guarda la configuracion en un archivo .ini
     * @param string $inifile Ruta del archivo .ini en el servidor
     * @return boolean
     */
    public function saveToIni($inifile = 'config.ini');

    /**
     * Regresa instancia de configuración de la base de datos cargada desde un archivo .ini valido
     * @param Modules\Basics $Basics
     * @param string $inifile Ruta del archivo .ini en el servidor
     * @return self
     */
    public static function fromIniFile(Modules\Basics $Basics = NULL, $inifile = 'config.ini');
}
