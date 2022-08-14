<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v002
 * @date 18/09/20
 */
if ( !defined('H-KEI') ) { die; }

function cb_api_admin_only(): void
{
    global $user, $out_api;
    if ($user->cb_get_user_id() === 0) {
        $out_api->responseOut(401, 'UNAUTHORIZED', [], ['UNAUTHORIZED']);
    }
    if (!$user->cb_is_admin_access()) {
        $out_api->responseOut(401, 'UNAUTHORIZED', [], ['UNAUTHORIZED']);
    }
}

return; ?>