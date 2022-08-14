<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v002
 * @date 18/09/20
 */
if ( !defined('H-KEI') ) { die; }

/**
 * Check file is uploaded or not
 * @param string $name need a $_FILES['<b>name</b>'] value
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function cb_file_uploaded(string $name): bool
{
    if (empty($_FILES)) {
        return false;
    }
    $file = $_FILES[$name];
    if (!file_exists($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
        return false;
    }
    return true;
}

return; ?>