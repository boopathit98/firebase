<?php

namespace boopathi\firebase;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\DatabaseManager;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Collection;

class Firebase
{

    
    /**
     * Set the current cart instance.
     *
     * @param string|null $instance
     *
     * @return \Gloudemans\Shoppingcart\Cart
     */

    public function send($to, $message) {
        $fields = array(
            'to' => $to,
            'data' => $message,
        );
        return $this->sendPushNotification($fields);
    }



    // function makes curl request to firebase servers
    private function sendPushNotification($fields) {

       

        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';

        $headers = array(
            'Authorization: key=AAAAIh7Bs_Y:APA91bHbTOsR6narFnuLHjGcIrUUsaocnUaMccT0pegMFSHfCU_VAhFfST_FCBW2t00L7adjxq-jveqASUfZEptBbvGF_3CU6OZmE1NZsC6I9ip8oUUdhyCMiF2yKUzcdPrsxSxXqknO',
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

        return $result;
    }
    
}
