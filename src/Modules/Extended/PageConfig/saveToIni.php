<?php

namespace NT5\Bulker\Modules\Extended\PageConfig;

use NT5\Bulker\Modules;
use NT5\Bulker\Modules\Util;
use NT5\Bulker\Modules\Basics\Warning;

trait saveToIni {

    /**
     * 
     * @return Modules\Basics
     */
    abstract public function Basics();

    /**
     * 
     * @return string
     */
    abstract public function getPageTitle();

    /**
     * 
     * @return boolean
     */
    abstract public function getFirstRun();

    /**
     * 
     * @return string
     */
    abstract public function getPageDomain();

    /**
     * 
     * @return boolean
     */
    abstract public function getEnableDebug();

    /**
     * Guarda la configuracion en un archivo .ini
     * @param string $ini Ruta del archivo .ini en el servidor
     * @return boolean
     */
    public function saveToIni($ini = 'config.ini') {

        $this->Basics()->setLog("Intentando guardar configuración en el archivo $ini...");

        $data = [
            "title" => $this->getPageTitle(),
            "first_run" => ($this->getFirstRun() ? "true" : "false"),
            "page_domain" => $this->getPageDomain(),
            "enable_debug" => ($this->getEnableDebug() ? "true" : "false")
        ];
        $ini_area = "Bulker";

        foreach ($data as $index => $value) {
            if (Util\Files::set_ini_file($ini, $ini_area, $index, $value)) {
                $this->Basics()->setLog("La variable %s fue guardada correctamente con el valor: %s", $index, $value);
                continue;
            } else {
                $this->Basics()->setLog("No se pudo guardar el archivo de configuración; operacion abortada");
                $this->Basics()->addWarning(Warning\WarningCodes::CANT_SAVE_PAGE_CONFIG_FILE);
                return FALSE;
            }
        }
        $this->Basics()->setLog("El archivo $ini fue guardado correctamente");
        return TRUE;
    }

}
