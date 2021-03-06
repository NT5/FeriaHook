<?php

namespace NT5\Bulker\Modules\Basics\Warning;

trait WarningChecks {

    /**
     * 
     * @return array
     */
    abstract function getWarnings();

    /**
     * 
     * @param int $Warning
     * @return bool
     */
    public function hasWarning($Warning) {
        return (in_array($Warning, $this->getWarnings(), TRUE));
    }

}
