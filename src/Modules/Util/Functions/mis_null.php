<?php

namespace NT5\Bulker\Modules\Util\Functions;

trait mis_null {

    /**
     * @see https://stackoverflow.com/questions/4993104
     * @return boolean
     */
    public static function mis_null() {
        foreach (func_get_args() as $arg) {
            if (is_null($arg)) {
                continue;
            } else {
                return false;
            }
        }
        return true;
    }

}
