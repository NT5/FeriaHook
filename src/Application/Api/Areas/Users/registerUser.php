<?php

namespace NT5\Bulker\Application\Api\Areas\Users;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Modules\App;
use NT5\Bulker\Modules\App\Users\UserEntry;
use NT5\Bulker\Modules\App\Users\TokenGenerator;
use NT5\Bulker\Application\Api\LoggedArea;

/**
 * 
 */
class registerUser extends LoggedArea {

    /**
     *
     * @var UserEntry
     */
    private $UserEnty;

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);
    }

    public function initVars() {
        $user = $this->UserEnty();

        $this->setVars([
            'new.user.id' => $user->getUserId(),
            'new.user.type' => $user->getUserType(),
            'new.user.name' => $user->getUserFullName(),
            'new.user.phone' => $user->getUserPhone(),
        ]);
    }

    public function CheckPost() {
        $user_name = filter_input(INPUT_POST, 'name');
        $user_phone = filter_input(INPUT_POST, 'phone');

        if ($user_name && $user_phone) {
            $user = $this->registerUser($user_name, $user_phone);
            $this->setUser($user);
        } else {
            $this->setVars([
                'error.code' => 1,
                'error.message' => 'No valid post body'
            ]);
        }

        if ($this->UserEnty()->getUserId() !== 0) {
            if (filter_input(INPUT_POST, 'make_token')) {
                $this->registerToken($this->UserEnty());
            }
            if (filter_input(INPUT_POST, 'make_judge')) {
                $this->setType(1, $this->UserEnty());
                $categoria_asignada = filter_input(INPUT_POST, 'categoria_asignada');
                if ($categoria_asignada) {
                    $con = new App\CategoriasAsignadas($this->Extended());
                    $con->registreCategoriaAsignada($this->UserEnty()->getUserId(), $categoria_asignada);
                }
            } else if (filter_input(INPUT_POST, 'make_advisor')) {
                $this->setType(2, $this->UserEnty());
            }
        } else {
            $this->setVars([
                'error.code' => 2,
                'error.message' => 'No se pudo registrar el usuario (ya existe?)'
            ]);
        }
    }

    public function setUp() {
        $this->UserEnty = new UserEntry();
    }

    /**
     * 
     * @return UserEntry
     */
    public function UserEnty(): UserEntry {
        return $this->UserEnty;
    }

    /**
     * 
     * @param UserEntry $User
     */
    private function setUser(UserEntry $User) {
        $this->UserEnty = $User;
    }

    /**
     * 
     * @param string $user_name
     * @param string $user_phone
     * @return UserEntry
     */
    private function registerUser(string $user_name, string $user_phone): UserEntry {
        $user = $this->getUsers()->registerUser($user_name, $user_phone);

        return $user;
    }

    private function registerToken(UserEntry $user) {
        $token = TokenGenerator::getUser();
        $registre_token = $this->getUsers()->registerUserToken($user->getUserId(), $token);
        if ($registre_token) {
            $this->setVar('new.user.token', $token);
        } else {
            $this->setVars([
                'error.code' => 3,
                'error.message' => 'No se pudo ingresar el token ' . $token
            ]);
        }
    }

    /**
     * 
     * @param int $type
     * @param UserEntry $user
     */
    private function setType(int $type, UserEntry $user) {
        switch ($type) {
            case 1:
            case 2:
                $user_type = $this->getUsers()->setUserType($user->getUserId(), $type);
                if ($user_type->getUserId() === 0 || $user_type->getUserType() !== $type) {
                    $this->setVars([
                        'error.code' => 4,
                        'error.message' => 'No se pudo ingresar el tipo: ' . $type
                    ]);
                } else {
                    $this->setUser($user_type);
                }
                break;
            default:
                break;
        }
    }

}
