<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v002
 * @date 18/09/20
 */
if ( !defined('H-KEI') ) { exit; }

function cb_json_encode(array $value, bool $forcedUnescape = true): ?string {
    $return = [];
    foreach ($value as $key1 => $val1) {
        if ( is_array($val1) ) {
            $return[$key1] = cb_json_encode($val1, FALSE);
        } else {
            $return[$key1] = cb_escape_json_string($val1);
        }
    }
    if ( $forcedUnescape === true ) {
        return json_encode($return, JSON_UNESCAPED_UNICODE);
    } else {
        return $return;
    }
}

return; ?>