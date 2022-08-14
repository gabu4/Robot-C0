<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 16/09/20
 */
if ( !defined('H-KEI') ) { exit; }

function cb_number_round($number,int $decimals=2,$fixed=FALSE) {
    $n = round(cb_price_clean($number), $decimals);
    if ( $fixed === TRUE ) {
        $e = explode('.',(string)$n);
        if ( !isset($e[1]) ) { $e[1] = ""; }
        for ( ;strlen($e[1]) < $decimals; ) { $e[1] .= '0'; }
        $n = $e[0].'.'.$e[1];
    }
    return $n;
}

return; ?>