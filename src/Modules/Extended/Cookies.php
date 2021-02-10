<?php

namespace NT5\Bulker\Modules\Extended;

use NT5\Bulker\Modules\Basics;

/**
 * @todo Documentar / Mejorar
 */
class Cookies extends Basics\BasicsExtend {

    /**
     *
     * @var type 
     */
    protected $cookie_data;

    /**
     *
     * @var type 
     */
    protected $cookie_meta;

    /**
     * 
     * @param string $name
     * @param Basics $Basics
     */
    public function __construct($name = 'bulker', Basics $Basics = NULL) {
        parent::__construct($Basics);

        $name = ($name) ?: 'bulker';

        $this->cookie_meta = array(
            "name" => $name,
            "expire" => (time() + ( 86400 * 30 )), // 30 Días
            "content" => array()
        );

        $this->cookie_data = $this->createMyCookie();
        $this->Basics()->setLog("Nueva instancia de Cookies creada");
    }

    /**
     * 
     * @return type
     */
    private function createMyCookie() {
        if (!filter_input(INPUT_COOKIE, $this->cookie_meta['name'])) {
            return $this->setMyCookie($this->cookie_meta['content']);
        } else {
            return filter_input(INPUT_COOKIE, $this->cookie_meta['name']);
        }
    }

    /**
     * 
     * @param type $string
     * @return type
     */
    private function setMyCookie($string) {
        $string = serialize($string);
        setcookie($this->cookie_meta['name'], $string, $this->cookie_meta['expire'], "/", "", false, true);
        $this->cookie_data = $string;
        return $string;
    }

    /**
     * 
     * @return type
     */
    public function getMyCookie() {
        return $this->cookie_data;
    }

    /**
     * 
     * @param type $sec
     * @return type
     */
    public function getCookie($sec) {
        $cookie = unserialize($this->getMyCookie());
        return ( isset($cookie[$sec]) ? $cookie[$sec] : NULL );
    }

    /**
     * 
     * @param type $sec
     * @param type $param
     */
    public function setCookie($sec, $param) {
        $cookie = unserialize($this->getMyCookie());
        $cookie[$sec] = $param;
        $this->setMyCookie($cookie);
    }

    /**
     * 
     * @param type $sec
     */
    public function delCookie($sec) {
        $cookie = unserialize($this->getMyCookie());
        if (isset($cookie[$sec])) {
            unset($cookie[$sec]);
            $this->setMyCookie($cookie);
        }
    }

}
