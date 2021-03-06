<?php

namespace NT5\Bulker\Application\Api;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Modules\Extended\ExtendedExtended;
use NT5\Bulker\Modules\Util\Functions;

/**
 * 
 */
abstract class Area extends ExtendedExtended {

    /**
     *
     * @var array
     */
    private $Vars = [];

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);

        $this->prepareArea();
    }

    public abstract function setUp();

    public abstract function CheckPost();

    public abstract function initVars();

    public function prepareArea() {
        $this->setUp();
        $this->CheckPost();
        $this->initVars();
    }

    /**
     * 
     * @param string $var
     * @return array|string
     */
    public function getPost(string $var = NULL) {
        if (!$var) {
            $POST = filter_input_array(INPUT_POST);
            return ($POST ?: []);
        } else {
            return filter_input(INPUT_POST, $var);
        }
    }

    /**
     * 
     * @param string $name
     * @param string $value
     */
    public function setVar($name, $value) {
        Functions::set_array_value($this->Vars, $name, $value);
    }

    /**
     * 
     * @param array $vars
     */
    public function setVars(array $vars) {
        foreach ($vars as $k => $v) {
            $this->setVar($k, $v);
        }
    }

    /**
     * 
     * @return array
     */
    public function getVars() {
        return $this->Vars;
    }

    /**
     * 
     * @param string $name
     * @return array
     */
    public function getVar($name) {
        return Functions::get_array_value($this->Vars, $name);
    }

    /**
     * 
     * @return string
     */
    public function display() {
        return json_encode($this->Vars, JSON_PRETTY_PRINT);
    }

}
