<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 16/09/20
 */
if ( !defined('H-KEI') ) { exit; }

/**
 * Image Resizer plugin
 * @param string $inFile input filename with full path
 * @param string $outFile output filename with full path
 * @param string $width image new width
 * @param string $height image new height
 * @param string $mime (optional) file mimetype (pre-defend)
 * @param boolean $force (optional) force replicate (default FALSE)
 * @return array include whit in 'path' (filepath) and 'name' (filename) keys
 */
function cb_img_resize( $inFile, $outFile, $width, $height, $mime = NULL, $force = FALSE ){
    $ifnpos = \strrpos($inFile, "/", -1);
    $inFileName = \substr($inFile, $ifnpos+1);
    $inPath = \substr($inFile,0,$ifnpos);

    $expos = \strrpos($inFileName, '.', -1);
    $fileExtension = \strtolower(\substr($inFileName, $expos+1));

    $ofnpos = \strrpos($outFile, "/", -1);
    $outFileName = \substr($outFile, $ofnpos+1);
    $outPath = \substr($outFile,0,$ofnpos);

    $returnArray = Array();

    if ( !is_dir($outPath) ) { mkdir($outPath, 0755, TRUE); }
    if ( ( $force === TRUE ) AND is_file( $outFile ) ) { unlink($outFile); }
    if ( !is_file( $outFile ) ) {
        // Eredeti méret lekérdezése
        list($width_orig, $height_orig) = getimagesize($inFile);
        $ratio_orig = $width_orig/$height_orig;
        if ( ($width_orig < $width) AND ($height_orig < $height) ) {
            copy($inFile, $outFile);
            $returnArray['path'] = $outFile;
            $returnArray['name'] = $outFileName;
            return $returnArray;
        }

        if ($width/$height > $ratio_orig) {
            $width = $height*$ratio_orig;
        } else {
            $height = $width/$ratio_orig;
        }
        $image_p = imagecreatetruecolor($width, $height);

        if ( $mime === NULL ) {
            if ( (strnatcmp(phpversion(),'5.3') >= 0) AND function_exists('finfo_open') ) {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                //    $mime = strtolower(finfo_file($finfo, CB_ROOTDIR.$inFile));
                $mime = strtolower(finfo_file($finfo, $inFile));
                finfo_close($finfo);
            } elseif ( function_exists('mime_content_type') ) {
                error_reporting(0);
                //    $mime = strtolower(mime_content_type(CB_ROOTDIR.$inFile));
                $mime = strtolower(mime_content_type($inFile));
            } else {
                if ( ($fileExtension === 'jpg') OR ($fileExtension === 'jpeg') ) {
                    $mime = "image/jpeg";
                } elseif ( $fileExtension == 'png' ) {
                    $mime = "image/png";
                } elseif ( $fileExtension == 'gif' ) {
                    $mime = "image/gif";
                }
            }
        }

        if ( ($mime === "image/jpeg") OR ($mime === "image/pjpeg") ) {
            $fileExtension = 'jpg';
            $image = imagecreatefromjpeg($inFile);
            cb_image_fix_orientation($image,$inFile);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
            imagejpeg($image_p, $outFile, 100);
        } elseif ($mime == "image/png") {
            $fileExtension = 'png';
            $image_p = imagecreatetruecolor($width, $height);
            imageAlphaBlending($image_p, false);
            imageSaveAlpha($image_p, true);
            $image = imageCreateFromPng($inFile);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
            imagepng($image_p, $outFile, 9);
        } elseif ($mime == "image/gif") {
            $fileExtension = 'gif';
            $image_p = imagecreatetruecolor($width, $height);
            imageAlphaBlending($image_p, false);
            imageSaveAlpha($image_p, true);
            $image = imagecreatefromgif($inFile);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
            imagegif($image_p, $outFile);
        } else {
            return FALSE;
        }
        imagedestroy($image_p);

        $return['path'] = $outFile;
        $return['name'] = $outFileName;

    } else {
        $return['path'] = $outFile;
        $return['name'] = $outFileName;
    }

    return $return;
}

return; ?>