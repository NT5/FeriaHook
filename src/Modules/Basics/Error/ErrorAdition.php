<?php

namespace NT5\Bulker\Modules\Basics\Error;

trait ErrorAdition {

    /**
     *
     * @var array
     */
    protected $Errors = [];

    /**
     * 
     * @param int $Error
     * @return \NT5\Bulker\Modules\Basics\Errors
     * @throws \Exception
     */
    public function addError($Error) {
        if (is_int($Error)) {
            $this->Errors[] = $Error;
            return $this;
        }
        throw new \Exception("No valid value");
    }

}
