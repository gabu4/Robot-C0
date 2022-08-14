<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 16/09/20
 */
if ( !defined('H-KEI') ) { exit; }

/**
 * Link cleaner, ideal for ordering or others
 * @param string $link url path
 * @param string $dkey link get parameter
 * @param string $value (optional) link get value (if empty, when the get parameter become to remove from the link)
 * @return string modifited url path
 */
function cb_link_clean($link = NULL,$dkey = NULL,$dvalue = NULL) {
    if ( $link == NULL || empty($link) ) { $link = CB_HTTPPAGEADDRESS; }

    $part0 = explode("?",$link);
    $newLink = $part0[0];
    $newLinkTail = "";
    if ( isset($part0[1]) ) {
        $part1 = explode("&",$part0[1]);
        foreach ( $part1 as $key => $value ) {
            $part2 = explode("=",$value);
            if ( $part2[0] == $dkey ) {
                unset($part1[$key]);
            } else {
                $newLinkTail .= ( empty($newLinkTail) ) ? "?".$part1[$key] : '&'.$part1[$key];
            }
        }
    }
    if ( $dvalue !== NULL ) {
        $newPart = $dkey."=".$dvalue;
        $newLinkTail .= ( empty($newLinkTail) ) ? "?".$newPart : '&'.$newPart;
    }
    $newLink .= $newLinkTail;

    return $newLink;
}

return; ?>