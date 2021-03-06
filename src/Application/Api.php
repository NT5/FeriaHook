<?php

namespace NT5\Bulker\Application;

use NT5\Bulker\Application\Api\init;
use NT5\Bulker\Application\Api\dispose;
use NT5\Bulker\Modules\Basics;
use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\ApiRoute;

/**
 * 
 */
class Api {

    /**
     *
     * @var ApiRoute
     */
    private $Route;

    /**
     *
     * @var Basics
     */
    private $Basics;

    /**
     *
     * @var Extended
     */
    private $Extended;

    use init\initBasics,
        init\initExtended,
        init\initRoute,
        init\initDisplay,
        dispose\disposeExtended;

    /**
     * 
     * @return $this
     */
    public function api() {
        $this->initBasics();
        $this->initExtended();
        $this->initRoute();
        $this->disposeExtended();
        $this->initDisplay();
        // print_r($this->getBasics()->getLogs());
        return $this;
    }

    /**
     * 
     * @return ApiRoute
     */
    public function getRoute() {
        return $this->Route;
    }

    /**
     * 
     * @return Basics
     */
    public function getBasics() {
        return $this->Basics;
    }

    /**
     * 
     * @return Extended
     */
    public function getExtended() {
        return $this->Extended;
    }

}
