<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v002
 * @date 18/09/20
 */
if ( !defined('H-KEI') ) { die; }

function cb_array_sort_by_length(array &$array): array
{
    usort($array, function ($a, $b) {
        return strlen($a) - strlen($b);
    });
    return $array;
}

return; ?>