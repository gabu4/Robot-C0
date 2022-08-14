<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v002
 * @date 18/09/20
 */
if ( !defined('H-KEI') ) { die; }

/**
 * Image uplodat to imageshack (checked to work 2016.06.)
 * @param string image path to upload
 * @return string imageshack url
 */
function cb_gen_imageshack(string $imagepath): string
{
    $url = 'http://imageshack.us/upload_api.php';
    $key = '7BDHJNPQ61e9bb9934d6f819b26b871b7dfc353f';
    $max_file_size = '5242880';
    $temp = $imagepath;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_URL, $url);

    $post = [
        "fileupload" => '@' . $temp,
        "key" => $key,
        "format" => 'json',
        "max_file_size" => $max_file_size,
        "Content-type" => "multipart/form-data"
    ];
    $RealTitleID = time();
    $args['fileupload'] = new CurlFile($temp, 'file/exgpd', $temp);
    $args['key'] = $key;
    $args['format'] = 'json';
    $args['Content-type'] = 'multipart/form-data';
    curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
    $response = curl_exec($ch);
    $json_a = json_decode($response, true);

    return $json_a['links']['image_link'];
}

return; ?>