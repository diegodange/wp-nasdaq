<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Suno_API {

    private static $instance;

    public static function getInstance() {
        if (self::$instance == NULL) {
        self::$instance = new self();
        }
        return self::$instance;
    }


    private function __construct() { }

    public static function GetCompanies(){
        $url = 'https://api.nasdaq.com/api/screener/stocks?tableonly=true&limit=20';

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $headers = array();  

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $resp = curl_exec($curl);
        $result = json_decode($resp);
        return $result;
        curl_close($curl);
    }
   
}
Suno_API::getInstance();
