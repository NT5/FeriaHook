<?php

namespace NT5\Bulker\Application\Api\Areas\Votacion;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\Area;
use NT5\Bulker\Modules\App\Votacion;

/**
 * 
 */
class getListFromUserId extends Area {

    /**
     *
     * @var Votacion
     */
    private $Controller;

    /**
     *
     * @var Votacion\VotacionEntry[]
     */
    private $List = [];

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);
    }

    public function initVars() {
        $list = [];
        foreach ($this->List as $entry) {
            $list[] = $entry->getJson();
        }
        $this->setVars([
            'votaciones' => $list
        ]);
    }

    public function CheckPost() {
        $Controller = $this->Controller;

        $post_id = filter_input(INPUT_POST, 'user_id');
        if ($post_id) {
            $items = $Controller->getVotacionFromUserId($post_id);
            if (count($items) > 0) {
                $this->List = $items;
            } else {
                $this->setVars([
                    'error.code' => 2,
                    'error.message' => 'No id found'
                ]);
            }
        } else {
            $this->setVars([
                'error.code' => 1,
                'error.message' => 'No post id variable'
            ]);
        }
    }

    public function setUp() {
        $this->Controller = new Votacion($this->Extended());
    }

}
