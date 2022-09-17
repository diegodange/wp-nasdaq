<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Dashboard{
    private static $instance;

    public static function getInstance() {
        if (self::$instance == NULL) {
        self::$instance = new self();
        }
        return self::$instance;
    }


    public function __construct() {
     
    }

    public static function layout(){
        
        $companies = Suno_API::GetCompanies();

        ?>
        <div class="wrap ativos-content">
            <div class="ativos-list-content"> 
                <h1>Configurar Ativo</h1>
                <p class="text-content"> Insira abaixo o <b> ATIVO </b> para Visualização no <b>CARD</b> e salve.</p>
                <select class="escolher-ativo" name="ativos[]" multiple="multiple">
                <?php
                    for ($i=0; $i < count($companies->data->table->rows) ; $i++) { 
                        echo '<option class="pb-3">'.$companies->data->table->rows[$i]->name.' - '.$companies->data->table->rows[$i]->symbol.'</option>';
                    }
                ?>
                </select>
            </div>
        </div>
        <?php





    }


}

Dashboard::getInstance();
