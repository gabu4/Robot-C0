<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v002
 * @date 18/09/20
 */
if ( !defined('H-KEI') ) { die; }

$cb_json_test_error = "";
function cb_is_json(string $string, bool $returnArray=false) {
    global $cb_json_test_error;

    // decode the JSON data
    $result = json_decode($string,$returnArray);

    // switch and check possible JSON errors
    switch (json_last_error()) {
        case JSON_ERROR_NONE:
            $cb_json_test_error = ''; // JSON is valid // No error has occurred
            break;
        case JSON_ERROR_DEPTH:
            $cb_json_test_error = 'The maximum stack depth has been exceeded.';
            break;
        case JSON_ERROR_STATE_MISMATCH:
            $cb_json_test_error = 'Invalid or malformed JSON.';
            break;
        case JSON_ERROR_CTRL_CHAR:
            $cb_json_test_error = 'Control character error, possibly incorrectly encoded.';
            break;
        case JSON_ERROR_SYNTAX:
            $cb_json_test_error = 'Syntax error, malformed JSON.';
            break;
        // PHP >= 5.3.3
        case JSON_ERROR_UTF8:
            $cb_json_test_error = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
            break;
        // PHP >= 5.5.0
        case JSON_ERROR_RECURSION:
            $cb_json_test_error = 'One or more recursive references in the value to be encoded.';
            break;
        // PHP >= 5.5.0
        case JSON_ERROR_INF_OR_NAN:
            $cb_json_test_error = 'One or more NAN or INF values in the value to be encoded.';
            break;
        case JSON_ERROR_UNSUPPORTED_TYPE:
            $cb_json_test_error = 'A value of a type that cannot be encoded was given.';
            break;
        default:
            $cb_json_test_error = 'Unknown JSON error occured.';
            break;
    }

    if ($cb_json_test_error !== '') { return false; }

    return $result;
}

return; ?>