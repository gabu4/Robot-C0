<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 16/09/20
 */
if ( !defined('H-KEI') ) { exit; }

function cb_password_strength($password,int &$point=0) {
    $min_character = 8;
    $p = 0;
    $number_only = TRUE;
    $bannedpasswords = @file(CB_CORE.'/bannedpasswords.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    // Validate password strength
    if ( !empty($bannedpasswords) && in_array(mb_strtolower($password,'utf8'),$bannedpasswords) ) { $p-=10; }
    $uppercase = preg_match('@[A-Z]@', $password);
    if ( $uppercase ) { $p++;$number_only=FALSE; }
    $lowercase = preg_match('@[a-z]@', $password);
    if ( $lowercase ) { $p++;$number_only=FALSE; }
    $number = preg_match('@[0-9]@', $password);
    if ( $number ) { $p++; }
    $specialChars = preg_match('@[^\w]@', $password);
    if ( $specialChars ) { $p++;$number_only=FALSE; }

    $length = strlen($password);
    if ( $length >= $min_character*5 ) { $p+=7; }
    elseif ( $length >= $min_character*4 ) { $p+=6; }
    elseif ( $length >= $min_character*3 ) { $p+=5; }
    elseif ( $length >= $min_character*2.5 ) { $p+=4; }
    elseif ( $length >= $min_character*2 ) { $p+=3; }
    elseif ( $length >= $min_character*1.5 ) { $p+=2; }
    elseif ( $length >= $min_character*1 ) { $p+=1; }

    if ( $number_only === TRUE ) { $p-=5; }
    $point = ( $p > 10 ? 10 : ( $p < 0 ? 0 : round($p) ) );

    if( $p >= 5) {
        return TRUE;
    }else{
        return FALSE;
    }
}

return; ?>