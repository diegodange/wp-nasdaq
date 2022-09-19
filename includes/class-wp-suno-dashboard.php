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
        add_action( 'admin_init', array( $this, __CLASS__ .'::ativo_registrar_opcoes'));
    }

    public static function estrutura_form_ativo() {
        echo '<h1 class="titulo_principal" style="padding-top:30px;">Configurar Ativo</h1>';
        echo '<div class="wrap">';
        echo '<form method="post" action="options.php">';
        settings_fields("selecionar-opcoes-ativos");
        do_settings_sections("ativos");               
        submit_button();
        echo '</form>';
        echo '</div>';
    }

    public static function ativo_registrar_opcoes(){
        register_setting("selecionar-opcoes-ativos", "select_ativo");
        add_settings_section("selecionar-opcoes-ativos", "", null, "ativos");
        add_settings_field("select_ativo", "Insira o ATIVO para Visualização no <b>CARD</b> e salve.", __CLASS__ .'::ativo_select_option', "ativos", "selecionar-opcoes-ativos"); 
    }

    public static function ativo_select_option(){
        $ativo = get_option('select_ativo');
        $companies = Suno_API::GetCompanies();
        ?>
        <!-- ATIVOS CONTENT -->
        <div class="wrap ativos-content">
            <div class="ativos-list-content">
                <select class="escolher-ativo" name="select_ativo[]" multiple="multiple">
                    <?php
                        for ($i=0; $i < count($companies->data->table->rows) ; $i++) { 
                            $option_value = $companies->data->table->rows[$i]->symbol;
                                echo '<option class="pb-3" value="'.$option_value.'">'.$companies->data->table->rows[$i]->name.' - '.$companies->data->table->rows[$i]->symbol.'</option>';
                            if ($ativo[0] == $option_value) {
                                echo '<option selected="selected" class="pb-3" value="'.$option_value.'">'.$companies->data->table->rows[$i]->name.' - '.$companies->data->table->rows[$i]->symbol.'</option>';
                            }
                        }
                    ?>
                </select>
            </div>
        </div>
        <!-- ATIVOS CONTENT -->
        <?php
    }
}

Dashboard::getInstance();
