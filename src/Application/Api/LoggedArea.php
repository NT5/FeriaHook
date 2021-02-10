<?php

namespace NT5\Bulker\Application\Api;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Modules\App\Users;
use NT5\Bulker\Modules\App\Users\UserEntry;

/**
 * 
 */
abstract class LoggedArea extends Area {

    /**
     *
     * @var UserEntry
     */
    private $LoggedUser;

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
        $this->Users = new Users($Extended);
        $this->checkLogin();

        parent::__construct($Extended);
    }

    public function checkLogin() {
        $session_token = filter_input(INPUT_POST, 'session_token');
        if ($session_token) {
            $this->LoggedUser = $this->getUsers()->getUserBySession($session_token);
        } else {
            $this->LoggedUser = new UserEntry();
        }
    }

    public function prepareArea() {
        if ($this->getUser()->getUserId() !== 0) {
            parent::prepareArea();
        } else {
            $this->setVars([
                'error.code' => 1,
                'error.message' => 'Need login'
            ]);
        }

        $this->setVars([
            'user' => [
                'id' => $this->getUser()->getUserId(),
                'name' => $this->getUser()->getUserFullName(),
                'phone' => $this->getUser()->getUserPhone()
            ]
        ]);
    }

    /**
     * 
     * @return Users
     */
    public function getUsers() {
        return $this->Users;
    }

    /**
     * 
     * @return UserEntry
     */
    public function getUser() {
        return $this->LoggedUser;
    }

}
