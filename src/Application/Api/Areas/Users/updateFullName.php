<?php

namespace NT5\Bulker\Application\Api\Areas\Users;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\LoggedArea;

/**
 * 
 */
class updateFullName extends LoggedArea {

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
        $type = $this->getUser()->getUserType();
        if ($type === 3) {
            $post_id = $this->getPost('user_id');
            $post_name = $this->getPost('name');
            if ($post_id !== NULL && $post_name) {
                $user = $this->getUsers()->updateUserName($post_id, $post_name);
                $this->setVars([
                    'success' => true,
                    'message' => 'Se actualizo el usuario: ' . $post_id,
                    'update' => $user->getJson()
                ]);
            } else {
                $this->setVars([
                    'error.code' => 1,
                    'error.message' => 'No post id or name variable'
                ]);
            }
        } else {
            $this->setVars([
                'error.code' => 3,
                'error.message' => 'No admin user'
            ]);
        }
    }

    public function setUp() {
        
    }

}
