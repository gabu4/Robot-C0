<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 23/07/21
 */
if ( !defined('H-KEI') ) { die; }

function cb_lang_replace($text) {
  global $lang;
  return $lang->cb_lang_replace_in_text($text);
}

return; ?>