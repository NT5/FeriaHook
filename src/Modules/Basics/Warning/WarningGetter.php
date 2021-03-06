<?php

namespace NT5\Bulker\Modules\Basics\Warning;

trait WarningGetter {

    /**
     *
     * @var array
     */
    protected $Warnings = [];

    /**
     * 
     * @param int $index
     * @return int|FALSE
     */
    public function getWarning($index) {
        return (array_key_exists($index, $this->getWarnings()) ? $this->getWarnings()[$index] : FALSE);
    }

    /**
     * 
     * @return array
     */
    public function getWarnings() {
        return $this->Warnings;
    }

}
