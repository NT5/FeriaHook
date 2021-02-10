<?php

namespace NT5\Bulker\Application\Api\dispose;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Modules\Util\Functions;

trait disposeExtended {

    /**
     * 
     * @return Extended
     */
    public abstract function getExtended();

    private function disposeExtended() {
        // $this->disposePageConfig();
        $this->disposeDatabase();
    }

    private function disposePageConfig() {
        $inifile = Functions::parseDir([__DIR__, str_repeat(".." . DIRECTORY_SEPARATOR, 5), "config.ini"]);

        $PageConfig = $this->getExtended()->PageConfig();

        $PageConfig->saveToIni($inifile);
    }

    private function disposeDatabase() {
        $Database = $this->getExtended()->Database();

        $Database->close();
    }

}
