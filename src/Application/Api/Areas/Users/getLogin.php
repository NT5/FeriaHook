<?php

namespace NT5\Bulker\Application\Api\Areas\Users;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Modules\App\Users;
use NT5\Bulker\Modules\App\Users\TokenGenerator;
use NT5\Bulker\Application\Api\Area;

/**
 * 
 */
class getLogin extends Area {

    /**
     *
     * @var Users
     */
    private $Users;

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);
    }

    public function initVars() {
        
    }

    public function CheckPost() {
        $user_token = filter_input(INPUT_POST, 'token');

        if ($user_token) {
            $user = $this->getUsers()->getUserByToken($user_token);

            if ($user->getUserId() !== 0) {
                $registre_token = TokenGenerator::getSession();
                $this->getUsers()->registerUserSession($user->getUserId(), $registre_token);

                $this->setVars([
                    'login.user' => [
                        'id' => $user->getUserId(),
                        'type' => $user->getUserType(),
                        'name' => $user->getUserFullName(),
                        'phone' => $user->getUserPhone()
                    ],
                    'login.session_token' => $registre_token
                ]);
            } else {
                $this->setVars([
                    'error.code' => 1,
                    'error.message' => 'No valid token'
                ]);
            }
        } else {
            $this->setVars([
                'error.code' => 2,
                'error.message' => 'No post token variable'
            ]);
        }
    }

    public function setUp() {
        $this->Users = new Users($this->Extended());
    }

    /**
     * 
     * @return Users
     */
    public function getUsers() {
        return $this->Users;
    }

}
