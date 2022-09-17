<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Suno_Shortcodes{
    private static $instance;

    public static function getInstance() {
        if (self::$instance == NULL) {
        self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct() {
        add_action('wp_body_open', [$this, 'Card_Ativo']);
    }
   
    function Card_Ativo() {
        $companies = Suno_API::GetCompanies();
        $company_single = Suno_API::GetCompanyInfos();

        for ($i=0; $i < count($companies->data->table->rows) ; $i++) { 
            // echo $companies->data->table->rows[$i]->symbol.' - '.$companies->data->table->rows[$i]->name.'</br>';
        }

        echo $company_single->data->symbol.' - '.$company_single->data->companyName.'</br>';
        
    }

}

Suno_Shortcodes::getInstance();