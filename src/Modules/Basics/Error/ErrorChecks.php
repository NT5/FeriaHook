<?php

namespace NT5\Bulker\Modules\Basics\Error;

trait ErrorChecks {

    /**
     * 
     * @return array
     */
    abstract function getErrors();

    /**
     * 
     * @param int $Error
     * @return bool
     */
    public function hasError($Error) {
        return (in_array($Error, $this->getErrors(), TRUE));
    }

}
