<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v002
 * @date 18/09/20
 */
if ( !defined('H-KEI') ) { exit; }

function cb_is_json_last_error(bool $toLog=false): ?string {
    global $cb_json_test_error;
    if ($toLog) {cb_error_log($cb_json_test_error);}
    return $cb_json_test_error;
}

return; ?>