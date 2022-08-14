<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 16/09/20
 */
if ( !defined('H-KEI') ) { exit; }

/**
 * Transform timestap value to a readable MYSQL datetime value
 * @param timestamp $time Timestamp value
 * @return string Readable date
 */
function cb_time_to_date($time = NULL) {
    if ( $time === NULL ) { $time = time(); }
    return date("Y-m-d H:i:s", $time);
}

return; ?>