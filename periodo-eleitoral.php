<?php
/*
Plugin Name: Período Eleitoral
Description: Plugin para gerenciar exibição de conteúdo durante o período eleitoral.
Version: 1.0
Author: Lucas Reis
*/

function pe_adicionar_opcao_periodo_eleitoral() {
    add_options_page(
        'Configurações de Período Eleitoral', 
        'Período Eleitoral', 
        'manage_options', 
        'periodo-eleitoral', 
        'pe_configuracao_periodo_eleitoral'
    );
}
add_action('admin_menu', 'pe_adicionar_opcao_periodo_eleitoral');

function pe_configuracao_periodo_eleitoral() {
    ?>
    <div class="wrap">
        <h1>Configurações de Período Eleitoral</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('pe_opcoes_grupo');
            do_settings_sections('pe_opcoes_grupo');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Está em período eleitoral?</th>
                    <td><input type="checkbox" name="pe_periodo_eleitoral" value="1" <?php checked(1, get_option('pe_periodo_eleitoral'), true); ?> /></td>
                </tr>
            </table>

            <footer style="margin-top: 20px; padding: 10px; border-top: 1px solid #ccc;">
                <p>Este é um plugin desenvolvido pela <strong>Devos - Tecnologias</strong></p>
            </footer>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function pe_registrar_opcoes() {
    register_setting('pe_opcoes_grupo', 'pe_periodo_eleitoral');
}
add_action('admin_init', 'pe_registrar_opcoes');

function pe_ocultar_elementos_peleit() {
    if (get_option('pe_periodo_eleitoral') == 1) {
        echo '<style>.PEleit, #PEleit { display: none !important; }</style>';
        
    }
}
add_action('wp_head', 'pe_ocultar_elementos_peleit');
