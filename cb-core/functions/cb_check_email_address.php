<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v002
 * @date 18/09/20
 */
if ( !defined('H-KEI') ) { die; }

/**
 * Validate the email address
 * @param string $email The Email adress
 * @return boolean <b>TRUE</b> if the email adress is valid, otherwise <b>FALSE</b>
 */
function cb_check_email_address(string $email): bool
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}

return; ?>