<?php

namespace NT5\Bulker\Modules\Basics;

use NT5\Bulker\Modules\Basics\Logger;

/**
 * Instancia que proporciona métodos para llevar un registro de ejecución
 */
class Logger implements Logger\Loggeable {

    use Logger\LoggerTrait;
}
