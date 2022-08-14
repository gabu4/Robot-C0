<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v002
 * @date 18/09/20
 */
if ( !defined('H-KEI') ) { die; }

function cb_api_token_only(): void
{
    global $out_api, $session;
    if (!$session->get_token()) {
        $out_api->responseOut(401, 'AUTH_FAIL_TOKEN_NOT_FOUND', [], ['AUTH_FAIL_TOKEN_NOT_FOUND']);
    }
}

return; ?>