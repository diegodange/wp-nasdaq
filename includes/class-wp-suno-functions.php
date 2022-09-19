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
        $lastSalePrice = $company_single->data->primaryData->lastSalePrice;
        $netChange = $company_single->data->primaryData->netChange;
        $percentageChange = $company_single->data->primaryData->percentageChange;
        $lastTradeTimestamp = $company_single->data->primaryData->lastTradeTimestamp;

        if ($percentageChange != '') {
            $percentageChange_Formated = '('.$company_single->data->primaryData->percentageChange.')';
        }
        
        if ($percentageChange == '') {
            $percentageChange_Formated = '';
        }

        // NASDAQ LISTED 
        if ($company_single->data->isNasdaqListed === true) {
           $listed = '<p class="isNasdaqListed"> Nasdaq <span class="isNasdaqListedSpan"> Listed </span> </p>';
        }
        if ($company_single->data->isNasdaqListed != true) {
            $listed = '';
        }
        // NASDAQ LISTED 

        // NASDAQ 100
        if ($company_single->data->isNasdaq100 === true) {
            $nasdaq_cem = '<p class="isNasdaq100 ms-3"> Nasdaq <span class="isNasdaq100Span"> 100 </span> </p>';
        }
        if ($company_single->data->isNasdaq100 != true) {
            $nasdaq_cem = '';
        }
        // NASDAQ 100

        echo '<div class="container">';
            echo '<div class="row d-flex justify-content-center">';
                echo '<div class="card_company col-8 p-5">';
                    echo '<div class="container-title">';
                        echo '<span class="company_title">'.$company_single->data->companyName.'</span><span class="company_symbol">('.$company_single->data->symbol.')</span>';
                    echo '</div>';
                    echo '<div class="company_infos">';
                        echo $listed.' '.$nasdaq_cem;
                    echo '</div>';
                    echo '<div class="company_prices">';
                        echo '<span class="lastSalePrice">'.$lastSalePrice.'</span> <span class="netChange">'.$netChange.'</span><span class="percentageChange">'.$percentageChange_Formated.'</span>';
                    echo '</div>';
                    echo '<div class="company_timestamp">';
                        echo '<span class="lastTradeTimestamp">'.$lastTradeTimestamp.'</span>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';

    }

}

Suno_Functions::getInstance();