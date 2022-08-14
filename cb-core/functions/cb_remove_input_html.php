<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 16/09/20
 */
if ( !defined('H-KEI') ) { exit; }

/**
 * Remove HTML content from string
 * @param string $html The content
 * @return string Cleaned HTML content
 */
function cb_remove_input_html($html) {
    $mit = array (
        "'<script[^<]*?>.*?</script>'si", // javascript eltüntetése
        "'<[\/\!]*?[^<>]*?>'si",  // HTML elemek eltüntetése
        "'([\r\n])[\s]+'",  // térközök
        "'&(quot|#34);'i",  // HTML entitások
        "'&(amp|#38);'i",
        "'&(lt|#60);'i",
        "'&(gt|#62);'i",
        "'&(nbsp|#160);'i",
        "'&(iexcl|#161);'i",
        "'&(cent|#162);'i",
        "'&(pound|#163);'i",
        "'&(copy|#169);'i",
        "'&#(\d+);'e");  // PHP kódként értelmezze

    $mire = array (
        "",
        "",
        "\\1",
        "\"",
        "&",
        "<",
        ">",
        " ",
        chr(161),
        chr(162),
        chr(163),
        chr(169),
        "chr(\\1)");

    return preg_replace_callback($mit, $mire, $html);
}

return; ?>