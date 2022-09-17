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
        $dados = Suno_API::GetCompanies();

        for ($i=0; $i < count($dados->data->table->rows) ; $i++) { 
            echo $dados->data->table->rows[$i]->symbol.' - '.$dados->data->table->rows[$i]->name.'</br>';
        }
        
    }

}

Suno_Shortcodes::getInstance();