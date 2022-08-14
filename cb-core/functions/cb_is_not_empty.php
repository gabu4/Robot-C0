<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 16/09/20
 */
if (!defined('H-KEI')) { exit; }

/**
 * If var is isset and not empty return TRUE else FALSE
 * @param mixed $var string or array
 * @param string $key (optional) array key, if have value, <b>$var</b> is need to be array
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function cb_is_not_empty($var, ?string $key = null): bool
{
    if (!isset($var)) {
        return false;
    }
    if (is_array($var) && $key !== null) {
        if (isset($var[$key]) && !empty($var[$key])) {
            return true;
        }
    } else {
        if (!empty($var)) {
            return true;
        }
    }
    return false;
}

return; ?>