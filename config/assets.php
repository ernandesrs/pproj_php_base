<?php

/**
 * Este arquivo possui um único objetivo de copiar os recursos criados em resources/ para a pasta pública public/
 * Esta ação é necessária pois será restrito o acesso à resources/ no entanto, os arquivos fontes(.js, .ts, .scss) serão implementadas * em resources/
 * 
 * Este arquivo será executado apenas localmente(conforme definido em .env) toda vez que o projeto for recarregado.
 */

if (!CONF_APP_LOCAL) return;

/**
 * estilos
 */
$styles = [
    "resources/css/front/custom.css" => "public/css/front/custom.css",
    "resources/css/admin/custom.css" => "public/css/admin/custom.css",
];

/**
 * scripts
 */
$scripts = [
    "resources/js/front/scripts.js" => "public/js/front/scripts.js",
    "resources/js/admin/scripts.js" => "public/js/admin/scripts.js",
    "node_modules/jquery/dist/jquery.js" => "public/js/scripts.js",
    "node_modules/boostrap/dist/js/bootstrap.js" => "public/js/bootstrap.js",
];

$resources = $styles + $scripts;

foreach ($resources as $source => $public) {
    $stylePath = CONF_BASE_PATH . "/{$source}";
    if (file_exists($stylePath)) {
        $path = CONF_BASE_PATH;
        $publicDirs = explode("/", $public) ?? [];
        foreach ($publicDirs as $publicDir) {
            $path .= "/{$publicDir}";
            if (!is_dir($path)) {
                if (!isset(pathinfo($path)["extension"])) {
                    mkdir($path);
                } else {
                    copy(CONF_BASE_PATH . "/{$source}", CONF_BASE_PATH . "/{$public}");
                }
            }
        }
    }
}