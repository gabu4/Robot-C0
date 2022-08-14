<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 16/09/20
 */
if ( !defined('H-KEI') ) { exit; }

function cb_number_format($price,$format='hu_HU') {
    $fmt = new NumberFormatter( $format, NumberFormatter::DECIMAL );
    $p = $fmt->format($price);
    return $p;
}

return; ?>