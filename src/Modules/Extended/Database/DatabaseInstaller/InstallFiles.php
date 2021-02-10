<?php

namespace NT5\Bulker\Modules\Extended\Database\DatabaseInstaller;

use NT5\Bulker\Modules\Extended\Database\DatabaseInstaller\InstallFiles;

/**
 * @todo Documentar
 */
class InstallFiles {

    use InstallFiles\initFiles;

    /**
     *
     * @var array
     */
    private static $FileList = [];

    /**
     *
     * @var array 
     */
    private static $BaseDir = array(__DIR__, "..", "..", "..", "..", "..", "sql");

    /**
     * 
     * @param string $area
     * @return array
     */
    public static function getArea($area) {
        if (array_key_exists($area, self::$FileList)) {
            return self::$FileList[$area];
        }
        return [];
    }

    /**
     * 
     * @return int
     */
    public static function getAreasCount() {
        return count(self::getFileArray());
    }

    /**
     * 
     * @return int
     */
    public static function getAreaCount($area) {
        return count(self::getArea($area));
    }

    /**
     * 
     * @param string $area
     * @param string $file
     */
    public static function addFile($area, $file) {
        self::$FileList[$area][] = $file;
    }

    /**
     * 
     * @return array
     */
    public static function getFileArray() {
        return self::$FileList;
    }

    /**
     * 
     * @return array
     */
    public static function getBaseDir() {
        return self::$BaseDir;
    }

}

InstallFiles::init();
