<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 16/09/20
 */
if ( !defined('H-KEI') ) { exit; }

/**
 * If var is empty return TRUE else FALSE, if var is not exist return FALSE
 * @param mixed $var string or array
 * @param string $key (optional) array key, if have value, <b>$var</b> is need to be array
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function cb_is_empty_x($var,$key = NULL) {
    if ( !isset($var) ) { return FALSE; }
    if ( is_array($var) && $key !== NULL ) {
        if ( !isset($var[$key]) ) { return FALSE; }
        if ( empty($var[$key]) ) { return TRUE; }
    } else {
        if ( empty($var) ) { return TRUE; }
    }
    return FALSE;
}

return; ?>