<?php

namespace NT5\Bulker\Application\Api\Areas\Proyectos;

use NT5\Bulker\Modules\Extended;
use NT5\Bulker\Application\Api\Area;
use NT5\Bulker\Modules\App\Proyectos;

/**
 * 
 */
class likeProyecto extends Area {

    /**
     *
     * @var Proyectos
     */
    private $Proyectos;

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
        $dislike = false;
        $like = false;

        $a = $this->Proyectos;
        $post_id = $this->getPost('id');
        $post_device = $this->getPost('device_uuid');

        if ($post_id !== NULL && $post_device !== NULL) {
            $like = $a->likeProyectoFromId($post_id, $post_device);
            if (!$like) {
                $dislike = $a->dislikeProyectoFromId($post_id, $post_device);
            }
            $this->setVars([
                'success' => true,
                'data' => [
                    'like' => $like,
                    'dislike' => $dislike
                ],
                'message' => 'Se sumo un like al proyecto id: ' . $post_id
            ]);
        } else {
            $this->setVars([
                'error.code' => 1,
                'error.message' => 'No post id variable'
            ]);
        }
    }

    public function setUp() {
        $this->Proyectos = new Proyectos($this->Extended());
    }

}
