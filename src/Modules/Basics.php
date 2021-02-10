<?php

namespace NT5\Bulker\Modules;

use NT5\Bulker\Modules\Basics;
use NT5\Bulker\Modules\Basics\Logger;
use NT5\Bulker\Modules\Basics\Warning;
use NT5\Bulker\Modules\Basics\Error;

/**
 * @todo Documentacion
 */
class Basics implements Logger\Loggeable, Error\ThrowableError, Warning\ThrowableWarning {

    use Basics\BasicsTrait;
}
