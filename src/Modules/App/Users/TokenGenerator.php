<?php

namespace NT5\Bulker\Modules\App\Users;

use NT5\Bulker\Modules\Util\Token;

/**
 * 
 */
class TokenGenerator {

    /**
     *
     * @var int
     */
    private static $Session_Length = 32;

    /**
     *
     * @var type 
     */
    private static $User_Length = 4;

    /**
     * 
     * @return string
     */
    public static function getSession() {
        $gen = new Token();
        return $gen->generate(self::$Session_Length);
    }

    /**
     * 
     * @return string
     */
    public static function getUser() {
        $gen = new Token();
        return $gen->generate(self::$User_Length);
    }

}
