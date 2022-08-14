<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 16/09/20
 */
if ( !defined('H-KEI') ) { exit; }

/**
 * Sort an multi-dimensional array by key
 * @param array $array The input array.
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function cb_ksort_multi(array &$array) {
    if ( is_array($array) ) {
        ksort($array);
        $array2 = array();
        foreach ($array as $key => $value) {
            ksort($value);
            $array2[$key] = $value;
        }
        return TRUE;
    } else {
        return FALSE;
    }
}

return; ?>