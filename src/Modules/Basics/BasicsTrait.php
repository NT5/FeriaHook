<?php

namespace NT5\Bulker\Modules\Basics;

use NT5\Bulker\Modules\Basics\Error;
use NT5\Bulker\Modules\Basics\Warning;
use NT5\Bulker\Modules\Basics\Logger;

trait BasicsTrait {

    use Error\ErrorTrait,
        Warning\WarningTrait,
        Logger\LoggerTrait;
}
