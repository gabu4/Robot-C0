<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 16/09/20
 */
if ( !defined('H-KEI') ) { exit; }

/**
 * Price clean, remove the blanks, and convert "," to "." character for to make a float price
 * @param string $price the price
 * @return float returning price,<br> this is mysql compabibile float value
 */
function cb_price_clean(&$price,$returnParameter=FALSE) {
    $a = array(' ', ',');
    $b = array('', '.');
    $result = (float) str_replace($a, $b, trim($price));
    if ( $returnParameter === TRUE ) { $price = $result; }
    return $result;
}

return; ?>