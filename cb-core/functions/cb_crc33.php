<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v002
 * @date 18/09/20
 */
if ( !defined('H-KEI') ) { die; }

function cb_crc33($string, int $length = 10): string
{
    return substr(md5(uniqid($string . rand(1, 6))), 0, $length);
}

return; ?>