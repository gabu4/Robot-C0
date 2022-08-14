<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 18/09/20
 */
if ( !defined('H-KEI') ) { die; }

function cb_json_decode_file(string $path, bool $forceReload = false)
{
    if (!is_file($path)) {
        return false;
    }
    $processName = 'cb_parse_json_file_container_' . crc32($path);
    global $$processName;

    if (!isset($$processName) || empty($$processName) || $forceReload === true) {
        $json = file_get_contents($path);
        $$processName = json_decode($json);
    }

    return $$processName;
}

return; ?>