<?php

namespace NT5\Bulker\Application\Api\Areas;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\Area;
use NT5\Bulker\Modules\Extended\Database;

/**
 * 
 */
class SQLInstall extends Area {

    /**
     *
     * @var Database\DatabaseInstaller
     */
    private $Installer;

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        $this->Installer = new Database\DatabaseInstaller($Extended);
        parent::__construct($Extended);
    }

    public function initVars() {
        $this->setVars([
            'database.install' => $this->Installer->isInstalled(),
            'database.date' => $this->Installer->getDateInstall(),
            // 'debug.logs' => print_r($this->Basics()->getLogs(), TRUE)
        ]);
    }

    public function CheckPost() {
        
    }

    public function setUp() {
        $this->Installer->Install();
    }

}
