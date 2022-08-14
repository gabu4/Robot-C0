<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 23/07/21
 */
if ( !defined('H-KEI') ) { die; }

function cb_array_awr(&$item, $key) {
  $notAllowKeysToSave = ['password'];

  $toDelete = FALSE;
  $keyLower = mb_strtolower($key);
  foreach ($notAllowKeysToSave as $v) {
    $vL = mb_strtolower($v);
    $vC = mb_strlen($vL);
    $keyLowerCutted = mb_substr($keyLower,0,$vC);
    if ( $vL === $keyLowerCutted ) { $toDelete = TRUE; }
  }
  if ( $toDelete ) {
    $item = "";
  } else {
    $item = htmlentities($item,ENT_QUOTES);
  }
}

return; ?>