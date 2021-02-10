<?php

namespace NT5\Bulker\Application\Api\Areas\Users;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\Area;
use NT5\Bulker\Modules\App\Users;

/**
 * 
 */
class getSession extends Area {

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
                'type' => $this->UserInfo->getUserType(),
                'phone' => $this->UserInfo->getUserPhone()
            ]
        ]);
    }

    public function CheckPost() {
        $u = $this->Users;

        $session_token = filter_input(INPUT_POST, 'session_token');
        if ($session_token) {
            $user = $u->getUserBySession($session_token);
            if ($user->getUserId() !== 0) {
                $this->UserInfo = $user;
            } else {
                $this->setVars([
                    'error.code' => 2,
                    'error.message' => 'Invalid session token'
                ]);
            }
        } else {
            $this->setVars([
                'error.code' => 1,
                'error.message' => 'No post session_token variable'
            ]);
        }
    }

    public function setUp() {
        $this->Users = new Users($this->Extended());
        $this->UserInfo = new Users\UserEntry();
    }

}
