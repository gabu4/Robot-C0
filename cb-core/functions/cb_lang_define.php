<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 21/07/21
 */
if ( !defined('H-KEI') ) { die; }

function cb_lang_define(string $name, string $text): void {
  global $lang;
  $lang->cb_lang_define($name, $text);
}

return; ?>