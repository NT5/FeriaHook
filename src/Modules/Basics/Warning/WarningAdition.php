<?php

namespace NT5\Bulker\Modules\Basics\Warning;

trait WarningAdition {

    /**
     *
     * @var array
     */
    protected $Warnings = [];

    /**
     * 
     * @param int $Warning
     * @return \NT5\Bulker\Modules\Basics\Warnings
     * @throws \Exception
     */
    public function addWarning($Warning) {
        if (is_int($Warning)) {
            $this->Warnings[] = $Warning;
            return $this;
        }
        throw new \Exception("No valid value");
    }

}
