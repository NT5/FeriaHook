<?php

namespace NT5\Bulker\Application\Api\init;

use NT5\Bulker\Modules\Basics;

trait initBasics {

    /**
     *
     * @var Basics
     */
    private $Basics;

    /**
     * 
     * @return Basics
     */
    public abstract function getBasics();

    private function initBasics() {
        date_default_timezone_set('America/Managua');

        $Basics = new Basics();

        $this->Basics = $Basics;
    }

}
