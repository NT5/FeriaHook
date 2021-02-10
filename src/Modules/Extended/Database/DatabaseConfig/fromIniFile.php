<?php

namespace NT5\Bulker\Modules\Extended\Database\DatabaseConfig;

use NT5\Bulker\Modules;
use NT5\Bulker\Modules\Util;
use NT5\Bulker\Modules\Basics\Warning;

trait fromIniFile {

    /**
     * Regresa instancia de configuración de la base de datos cargada desde un archivo .ini valido
     * @param Modules\Basics $Basics
     * @param string $inifile Ruta del archivo .ini en el servidor
     * @return PageConfig Regresa instancia de configuracion creada
     */
    public static function fromIniFile(Modules\Basics $Basics = NULL, $inifile = 'config.ini') {
        $Basics = ($Basics) ?: new Modules\Basics();
        $ini = Util\Files::load_ini_file($inifile);

        $valid_structure = [
            "server",
            "username",
            "password",
            "database"
        ];
        $ini_area = "MySQL";

        $Basics->setLog("Intentando crear configuración de base de datos con $inifile...");

        if ($ini) {
            $Basics->setLog("Comprobando estructura de $inifile...");

            if (Util\Functions::checkArray([$ini_area], $ini) && Util\Functions::checkArray($valid_structure, $ini[$ini_area])) {
                $instance = new self(
                        $ini[$ini_area]["server"], $ini[$ini_area]["username"], $ini[$ini_area]["password"], $ini[$ini_area]["database"], $Basics
                );
                $Basics->setLog("Instancia de configuración de base de datos creada correctamente con $inifile");

                return $instance;
            } else {
                $Basics->addWarning(Warning\WarningCodes::DATABASE_CONFIGURATION_INVALID_FORMAT);
                $Basics->setLog("El archivo $inifile tiene una estructura invalida");

                return new self(NULL, NULL, NULL, NULL, $Basics);
            }
        } else {
            $Basics->addWarning(Warning\WarningCodes::CANT_LOAD_DATABASE_CONFIGURATION_FILE);
            $Basics->setLog("El archivo $inifile no pudo ser cargado");

            return new self(NULL, NULL, NULL, NULL, $Basics);
        }
    }

}
