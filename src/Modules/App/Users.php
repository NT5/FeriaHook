<?php

namespace NT5\Bulker\Modules\App;

use NT5\Bulker\Modules\App\Users\Database;
use NT5\Bulker\Modules\Extended\ExtendedExtended;
use NT5\Bulker\Modules\Extended;

/**
 * 
 */
class Users extends ExtendedExtended {

    use Database\getUser,
        Database\getUserByToken,
        Database\getUserBySession,
        Database\getUserListByType,
        Database\getUserTokenList,
        Database\setUserType,
        Database\updateUserName,
        Database\registerUser,
        Database\registerUserSession,
        Database\registerUserToken,
        Database\removeUserFromId;

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);

        $this->Basics()->setLog("Nueva clase controladora de usuarios creada");
    }

}
