<?php

namespace NT5\Bulker\Application\Api\Areas\Users;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\Area;
use NT5\Bulker\Modules\App\Users;
use NT5\Bulker\Modules\App\CategoriasAsignadas;

/**
 * 
 */
class getListFromType extends Area {

    /**
     *
     * @var Users
     */
    private $Controller;

    /**
     *
     * @var Users\UserEntry[]
     */
    private $EntryList = [];

    /**
     *
     * @var int
     */
    private $EntryType = 0;

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);
    }

    public function initVars() {
        $list = [];
        $categorias = new CategoriasAsignadas($this->Extended());

        foreach ($this->EntryList as $entry) {
            $structure = [];
            if ($entry->getUserType() === 1) {
                $categorias_user = $categorias->getCategoriaListFromUserId($entry->getUserId());
                $structure = [
                    "user" => $entry->getJson(),
                    "categoria" => (count($categorias_user) > 0 ? $categorias_user[0]->getJson() : (new \NT5\Bulker\Modules\App\Categorias\CategoriaEntry())->getJson())
                ];
            } else {
                $structure = $entry->getJson();
            }
            $list[] = $structure;
        }
        $this->setVars([
            'users' => $list
        ]);
    }

    public function CheckPost() {
        $controller = $this->Controller;

        $post_usertype = $this->getPost('user_type');
        if ($post_usertype) {
            $list = $controller->getUserListByType($post_usertype);
            if (count($list) > 0) {
                $this->EntryList = $list;
                $this->EntryType = $post_usertype;
            } else {
                $this->setVars([
                    'error.code' => 2,
                    'error.message' => 'No id found'
                ]);
            }
        } else {
            $this->setVars([
                'error.code' => 1,
                'error.message' => 'No post user_type variable'
            ]);
        }
    }

    public function setUp() {
        $this->Controller = new Users($this->Extended());
    }

}
