<?php

namespace NT5\Bulker\Modules\Basics\Warning;

trait WarningTrait {

    /**
     *
     * @var array
     */
    protected $Warnings = [];

    use WarningAdition,
        WarningGetter,
        WarningChecks;
}
