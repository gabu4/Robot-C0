<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 16/09/20
 */
if ( !defined('H-KEI') ) { exit; }

/**
 * Checks if a value exists in a multi-dimensional array
 *
 * @param mixed $needle The searched value.
 * If needle is a string, the comparison is done in a case-sensitive manner.
 * @param array $haystack The array.
 * @param bool $strict [optional]<br>
 * If the third parameter strict is set to <b>TRUE</b> then the <b>cb_in_array_multi</b> function will also check the types of the needle in the haystack.
 *
 * @return bool <b>TRUE</b> if needle is found in the array, <b>FALSE</b> otherwise.
 *  */
function cb_in_array_multi($needle, array $haystack, $strict = '&false;') {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && cb_in_array_multi($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}

return; ?>