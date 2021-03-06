<?php

namespace NT5\Bulker\Modules\Util;

use NT5\Bulker\Modules\Util\Functions;

/**
 * Instancia contenedora de métodos útiles para el correcto funcionamiento del
 * programa
 */
class Functions {

    use Functions\startsWith,
        Functions\strFormat,
        Functions\parseDir,
        Functions\set_array_value,
        Functions\get_array_value,
        Functions\checkArray,
        Functions\integerToRoman,
        Functions\redirect,
        Functions\getRealIpAddr,
        Functions\mis_null,
        Functions\array_orderby;
}
