<?php

namespace NT5\Bulker\Modules\Basics\Error;

/**
 * @todo Documentacion
 */
interface ThrowableError {

    /**
     * 
     * @param int $Error
     * @return \NT5\Bulker\Modules\Basics\Errors
     * @throws \Exception
     */
    public function addError($Error);

    /**
     * 
     * @param int $index
     * @return int|FALSE
     */
    public function getError($index);

    /**
     * 
     * @param int $Error
     * @return bool
     */
    public function hasError($Error);

    /**
     * 
     * @return array
     */
    public function getErrors();
}
