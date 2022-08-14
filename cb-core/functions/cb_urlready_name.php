<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v002
 * @date 27/12/20
 */
if ( !defined('H-KEI') ) { exit; }

/**
 * Remove accent and some special CHAR from string
 * @param string $text input string
 * @param boolean $lowerCase force lower case output
 * @param integer $limit max output character, if 0 then no limit, otherwise cut the end to fit the limit
 * @return string output string
 */
function cb_urlready_name($text, $lowerCase = FALSE, $limit = 0) {
    if ( $lowerCase === TRUE ) { $text = mb_strtolower($text,'utf8'); }
    if ( $limit > 0 ) {
        $nc1 = substr($text." ", 0, $limit);
        $sp = strrpos($nc1, ' ', -1);
        $text = substr($nc1, 0, $sp);
    }

    $text = cb_remove_accent($text);
    $a = array(' ','\\','/','&','"',"'","!","(",")","[","]","{","}");
    $b = array('-','-','-','-','-','-','-','-','-','-','-','-','-');
    $text = str_replace($a, $b, $text);

    return $text;
}

return; ?>