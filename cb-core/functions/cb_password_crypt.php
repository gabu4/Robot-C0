<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 16/09/20
 */
if ( !defined('H-KEI') ) { exit; }

/**
 * Generate a password to a crypted string
 * @param mixed $password The original password
 * @return string Undecodable string
 */
function cb_password_crypt($password) {
    $a = hash('sha512',$password);
    return $a;
}

return; ?>