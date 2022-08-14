<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v002
 * @date 18/09/20
 */
if ( !defined('H-KEI') ) { die; }

/**
 * Generate one custom length random code
 * @param integer $length [optional]<br>Code length (default: 8)
 * @return string Generated code
 */
function cb_generate_code(int $length = 8): string
{
    $chars = "abcdefghijkmnpqrstuvwxyz23456789";
    srand((double)microtime() * 1000000);
    $i = 0;
    $pass = '';
    while ($i < $length) {
        $num = rand() % 31;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
}

return; ?>