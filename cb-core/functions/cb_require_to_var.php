<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 16/09/20
 */
if ( !defined('H-KEI') ) { exit; }

function cb_require_to_var($file){
    ob_start();
    require($file);
    $var = ob_get_clean();
    return $var;
}

return; ?>