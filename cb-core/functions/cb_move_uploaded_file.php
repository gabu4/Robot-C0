<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 16/09/20
 */
if ( !defined('H-KEI') ) { exit; }

function cb_move_uploaded_file(string $filename, string $destination) {
    move_uploaded_file($filename, $destination);

    $f = explode("/", $destination);
    $filename = end($f);
    $e = explode(".", $filename);
    $ext = end($e);
    try {
        $exif = @exif_read_data($destination);

        $orientation = ( isset($exif['Orientation']) ) ? $exif['Orientation'] : 1;

        if (isset($orientation) && $orientation != 1){
            switch ($orientation) {
                case 3:
                    $deg = 180;
                    break;
                case 6:
                    $deg = 270;
                    break;
                case 8:
                    $deg = 90;
                    break;
            }

            if ($deg) {

                // If png
                if ($ext == "png") {
                    $img_new = imagecreatefrompng($destination);
                    $img_new = imagerotate($img_new, $deg, 0);

                    // Save rotated image
                    imagepng($img_new,$destination,9);
                } elseif ( $ext == "gif" ) {
                    $img_new = imagecreatefromgif($destination);
                    $img_new = imagerotate($img_new, $deg, 0);

                    // Save rotated image
                    imagegif($img_new,$destination);
                } elseif ( $ext == "jpg" || $ext == "jpeg" ) {
                    $img_new = imagecreatefromjpeg($destination);
                    $img_new = imagerotate($img_new, $deg, 0);

                    // Save rotated image
                    imagejpeg($img_new,$destination,100);
                }
            }
        }

    } catch (Exception $e) {
        cbd( "error: ".$e);
    }
}

return; ?>