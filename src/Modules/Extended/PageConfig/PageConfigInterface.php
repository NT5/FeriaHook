<?php

namespace NT5\Bulker\Modules\Extended\PageConfig;

use NT5\Bulker\Modules;
use NT5\Bulker\Modules\Extended;

interface PageConfigInterface {

    /**
     * 
     * @return Modules\Basics
     */
    public function Basics();

    /**
     * 
     * @return string
     */
    public function getPageTitle();

    /**
     * 
     * @return boolean
     */
    public function getFirstRun();

    /**
     * 
     * @return string
     */
    public function getPageDomain();

    /**
     * 
     * @return boolean
     */
    public function getEnableDebug();

    /**
     * 
     * @param string $title
     * @return string
     */
    public function setPageTitle($title);

    /**
     * 
     * @param boolean $first_run
     * @return boolean
     */
    public function setFirstRun($first_run);

    /**
     * 
     * @param string $page_domain
     * @return string
     */
    public function setPageDomain($page_domain);

    /**
     * 
     * @param boolean $enable_debug
     * @return boolean
     */
    public function setEnableDebug($enable_debug);

    /**
     * Guarda la configuracion en un archivo .ini
     * @param string $ini Ruta del archivo .ini en el servidor
     * @return boolean
     */
    public function saveToIni($ini = 'config.ini');

    /**
     * Regresa instancia de configuración de la pagina web cargada desde un archivo .ini valido
     * @param Modules\Basics $Basics
     * @param string $inifile Ruta del archivo .ini en el servidor
     * @return Extended\PageConfig Regresa instancia de configuracion creada
     */
    public static function fromIniFile(Modules\Basics $Basics = NULL, $inifile = 'config.ini');
}
