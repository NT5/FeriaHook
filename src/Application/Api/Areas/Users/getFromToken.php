<?php

namespace NT5\Bulker\Application\Api\Areas\Users;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\Area;
use NT5\Bulker\Modules\App\Users;

/**
 * 
 */
class getFromToken extends Area {

    /**
     *
     * @var Users
     */
    private $Users;

    /**
     *
     * @var Users\UserEntry

     */
    private $UserInfo;

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);
    }

    public function initVars() {
        $this->setVars([
            'user' => [
                'id' => $this->UserInfo->getUserId(),
                'name' => $this->UserInfo->getUserFullName(),
                'phone' => $this->UserInfo->getUserPhone(),
                'type' => $this->UserInfo->getUserType()
            ]
        ]);
    }

    public function CheckPost() {
        $u = $this->Users;

        $token = filter_input(INPUT_POST, 'token');
        if ($token) {
            $user = $u->getUserByToken($token);
            if ($user->getUserId() !== 0) {
                $this->UserInfo = $user;
            } else {
                $this->setVars([
                    'error.code' => 2,
                    'error.message' => 'Invalid token found'
                ]);
            }
        } else {
            $this->setVars([
                'error.code' => 1,
                'error.message' => 'No post token variable'
            ]);
        }
    }

    public function setUp() {
        $this->Users = new Users($this->Extended());
        $this->UserInfo = new Users\UserEntry();
    }

}
