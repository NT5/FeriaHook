<?php

namespace NT5\Bulker\Application\Api\Areas\Users;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\LoggedArea;

/**
 * 
 */
class removeFromId extends LoggedArea {

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
            if ($post_id !== NULL) {
                $this->getUsers()->removeUserFromId($post_id);
                $this->setVars([
                    'success' => true,
                    'message' => 'Se borro el usuario id: ' . $post_id
                ]);
            } else {
                $this->setVars([
                    'error.code' => 1,
                    'error.message' => 'No post id variable'
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
