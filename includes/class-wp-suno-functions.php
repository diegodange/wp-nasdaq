<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Suno_Functions{
    private static $instance;

    public static function getInstance() {
        if (self::$instance == NULL) {
        self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct() {
        add_action('wp_body_open', [$this, 'Card_Ativo'], 0);
    }
   
    function Card_Ativo() {
        $company_single = Suno_API::GetCompanyInfos();

        if ($company_single->data->isNasdaqListed === true) {
           $listed = '<p class="isNasdaqListed"> Nasdaq <span class="isNasdaqListedSpan"> Listed </span> </p>';
        }

        if ($company_single->data->isNasdaq100 === true) {
            $nasdaq_cem = '<p class="isNasdaq100 ms-3"> Nasdaq <span class="isNasdaq100Span"> 100 </span> </p>';
        }

        echo '<div class="container">';
            echo '<div class="row d-flex justify-content-center">';
                echo '<div class="card_company col-6 p-5">';
                    echo '<span class="company_title">'.$company_single->data->companyName.'</span><span class="company_symbol ps-2">('.$company_single->data->symbol.')</span>';
                    echo $listed.' '.$nasdaq_cem;
                echo '</div>';
            echo '</div>';
        echo '</div>';

    }

}

Suno_Functions::getInstance();