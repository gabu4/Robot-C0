<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 21/07/21
 */
if ( !defined('H-KEI') ) { die; }

function cb_lang_text(string $text): string {
  global $lang;
  return $lang->cb_lang_text($text);
}

return; ?>