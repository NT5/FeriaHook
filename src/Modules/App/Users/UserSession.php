<?php

namespace NT5\Bulker\Modules\App\Users;

/**
 * @todo Documentar
 */
class UserSession {

    /**
     *
     * @var int
     */
    private $User_Id;

    /**
     *
     * @var string
     */
    private $Session_Token;

    /**
     *
     * @var string
     */
    private $Create_at;

    /**
     * 
     * @param int $User_Id
     * @param string $Session_Token
     * @param string $Create_at
     */
    public function __construct($User_Id, $Session_Token, $Create_at) {
        $this->User_Id = $User_Id;
        $this->Session_Token = $Session_Token;
        $this->Create_at = $Create_at;
    }

    /**
     * 
     * @return int
     */
    public function getUser_Id() {
        return $this->User_Id;
    }

    /**
     * 
     * @return string
     */
    public function getSession_Token() {
        return $this->Session_Token;
    }

    /**
     * 
     * @return string
     */
    public function getCreate_at() {
        return $this->Create_at;
    }

}
