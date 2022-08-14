<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v002
 * @date 18/09/20
 */
if ( !defined('H-KEI') ) { die; }

/**
 * Generate tiny url from a long URL (checked to work 2019.01.)
 * @param string url address
 * @return string tiny url
 */
function cb_gen_tiny_url(string $url): string
{
    if (substr($url, 0, 7) !== 'http://' && substr($url, 0, 8) !== 'https://') {
        $protocol = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
        $url = $protocol . @$_SERVER['HTTP_HOST'] . '/' . $url;
    }
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, 'http://tinyurl.com/api-create.php?url=' . $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

return; ?>