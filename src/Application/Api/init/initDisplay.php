<?php

namespace NT5\Bulker\Application\Api\init;

use NT5\Bulker\Application\Api\ApiRoute;
use NT5\Bulker\Modules\Basics;
use NT5\Bulker\Modules\Extended;

trait initDisplay {

    /**
     * 
     * @return ApiRoute
     */
    public abstract function getRoute();

    /**
     * 
     * @return Basics
     */
    public abstract function getBasics();

    /**
     * 
     * @return Extended
     */
    public abstract function getExtended();

    /**
     * 
     */
    private function initDisplay() {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');

        $Area = $this->getRoute()->getArea();

        if ($Area) {
            echo $Area->display();
        } else {
            echo "No areaclass found.";
        }
    }

}
