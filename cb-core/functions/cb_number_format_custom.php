<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 16/09/20
 */
if ( !defined('H-KEI') ) { exit; }

function cb_number_format_custom($number,$decimals=-1,$dec_point=",",$thousands_sep=" ") {
    cb_price_clean($number,TRUE);
    if ( $decimals === -1 ) {
        $n = cb_floor($number,10);
    } else {
        $n = cb_floor($number,$decimals);
    }

    $d = explode('.', $n);
    if (isset($d[1])) {
        $decimals = strlen($d[1]);
    } else { $decimals = 0; }

    $out_number = number_format($n,$decimals,$dec_point,$thousands_sep);
    return $out_number;
}

return; ?>