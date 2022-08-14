<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 16/09/20
 */
if ( !defined('H-KEI') ) { exit; }

/**
 * Remove new row elements from html ( \r\n )
 * @param string $html
 * @return string cleaned html code
 */
function cb_make_json_ready_html($html) {
    $html = str_replace("\r\n","",$html);

    return $html;
}

return; ?>