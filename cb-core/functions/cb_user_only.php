<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 16/09/20
 */
if ( !defined('H-KEI') ) { exit; }

function cb_user_only() {
    global $user, $out_html;
    if ( $user->cb_get_user_id() === 0 ) { $out_html->loadErrorPage403(); }
}

return; ?>