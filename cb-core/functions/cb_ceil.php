<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v002
 * @date 18/09/20
 */
if ( !defined('H-KEI') ) { die; }

function cb_ceil(float $number, int $floatingPoint = 0): ?float
{
    $n = $number;
    if ($floatingPoint > 0) {
        $c = 1;
        for ($i = 0; $i < $floatingPoint; $i++) {
            $c = $c * 10;
        }
        $n = ceil($n * $c) / $c;
    }
    return $n;
}

return; ?>