<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 16/09/20
 */
if ( !defined('H-KEI') ) { exit; }

function cb_transform_jsonlike_to_json($string) {
    $a = array('[', ']', ';');
    $b = array('{', '}', ',');
    $json = str_replace($a, $b, $string);

    return $json;
}

return; ?>