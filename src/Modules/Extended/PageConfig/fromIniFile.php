<?php

namespace NT5\Bulker\Modules\Extended\PageConfig;

use NT5\Bulker\Modules;
use NT5\Bulker\Modules\Util;
use NT5\Bulker\Modules\Basics\Warning;
use NT5\Bulker\Modules\Extended\PageConfig;

trait fromIniFile {

    /**
     * Regresa instancia de configuración de la pagina web cargada desde un archivo .ini valido
     * @param Modules\Basics $Basics
     * @param string $inifile Ruta del archivo .ini en el servidor
     * @return PageConfig Regresa instancia de configuracion creada
     */
    public static function fromIniFile(Modules\Basics $Basics = NULL, $inifile = 'config.ini') {
        $Basics = ($Basics) ?: new Modules\Basics();
        $ini = Util\Files::load_ini_file($inifile);

        if ($ini) {
            $Basics->setLog("Comprobando estructura de $inifile...");

            $valid_structure = [
                "title",
                "first_run",
                "page_domain",
                "enable_debug"
            ];
            $ini_area = "Bulker";

            if (Util\Functions::checkArray([$ini_area], $ini) && Util\Functions::checkArray($valid_structure, $ini[$ini_area])) {
                $instance = new self(
                        $Basics, $ini[$ini_area]["title"], $ini[$ini_area]["first_run"], $ini[$ini_area]["page_domain"], $ini[$ini_area]["enable_debug"]
                );
                $Basics->setLog("Instancia de configuración creada correctamente con $inifile");

                return $instance;
            } else {
                $Basics->setLog("El archivo $inifile tiene una estructura invalida");

                $Basics->addWarning(Warning\WarningCodes::PAGE_CONFIGURATION_INVALID_FORMAT);
                $Basics->addWarning(Warning\WarningCodes::DEFAULT_PAGE_CONFIGURATION);

                return new self();
            }
        } else {
            $Basics->setLog("El archivo $inifile no pudo ser cargado");

            $Basics->addWarning(Warning\WarningCodes::CANT_LOAD_PAGE_CONFIGURATION_FILE);
            $Basics->addWarning(Warning\WarningCodes::DEFAULT_PAGE_CONFIGURATION);

            return new self();
        }
    }

}
