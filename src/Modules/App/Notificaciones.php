<?php

namespace NT5\Bulker\Modules\App;

use NT5\Bulker\Modules\Extended\ExtendedExtended;
use NT5\Bulker\Modules\Extended;

/**
 * 
 */
class Notificaciones extends ExtendedExtended {

    private $url = "https://fcm.googleapis.com/fcm/send";
    private $api_key = "AAAA7GImZHc:APA91bGXloYwkXHjoxU97LTXwksfebT0IszaUrwFZT46nqYS0kVLVmS5NQZsYLySvDRoG6BTMpl06ADK10PGA_YMATIwRyOA3m6Te_7SzoBfvhO8cqhRTAUkjeq5oImBXKcQF5rPMw9j";

    /**
     * 
     * @param Extended $Extended
     */
    public function __construct(Extended $Extended = NULL) {
        parent::__construct($Extended);

        $this->Basics()->setLog("Nueva clase controladora de Notificaciones creada");
    }

    private function curlSend($headers, $fields) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function sendToAll($title, $message) {
        $notification = array(
            'title' => $title,
            'body' => $message,
            'sound' => 'default',
        );
        $fields = array(
            'notification' => $notification,
            'priority' => 'HIGH',
            'to' => '/topics/all',
        );

        $headers = array(
            'Authorization: key=' . $this->api_key,
            'Content-Type: application/json'
        );

        $result = $this->curlSend($headers, $fields);

        return $result;
    }

}
