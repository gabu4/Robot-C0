<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v002
 * @date 21/07/21
 */
if ( !defined('H-KEI') ) { exit; }

function cb_remove_space(string $text): string {
    $a = array(' ');
    $b = array('');
    return str_replace($a, $b, $text);
}

return; ?>