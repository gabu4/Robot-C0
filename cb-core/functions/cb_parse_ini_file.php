<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v002
 * @date 18/09/20
 */
if ( !defined('H-KEI') ) { die; }

function cb_parse_ini_file(string $path, bool $multi_dimension = true): ?array
{
    if (!is_file($path)) {
        return false;
    }
    $processName = 'cb_parse_ini_file_container_' . crc32($path . '_' . ($multi_dimension === true ? 'b' : 'a'));
    global $$processName;

    if (!isset($$processName) || empty($$processName)) {
        $$processName = parse_ini_file($path, $multi_dimension);
    }

    return $$processName;
}

return; ?>