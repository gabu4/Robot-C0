<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 20/07/21
 */
if ( !defined('H-KEI') ) { die; }

function cb_lang_load(string $module, bool $isAdmin = FALSE): void {
  global $lang;
  $lang->setLoadLangStore($module,$isAdmin);
}

return; ?>