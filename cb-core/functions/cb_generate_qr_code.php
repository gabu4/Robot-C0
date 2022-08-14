<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v002
 * @date 18/09/20
 */
if ( !defined('H-KEI') ) { die; }

function cb_generate_qr_code(string $codeText, int $errorCorrection = 1, int $size = 10): ?string
{
    if (empty($codeText)) {
        return false;
    }

    $code_cr = crc32($codeText . '-' . $errorCorrection . '-' . $size);

    $outPath = CB_TEMP . "/qrcodegen";
    if (!is_dir($outPath)) {
        mkdir($outPath, 0755, true);
    }
    $path = $outPath . "/" . $code_cr . ".png";
    if (is_file($path)) {
        unlink($path);
    }

    switch ($errorCorrection) {
        case 2:
            $ecc_level = 'QR_ECLEVEL_M';
            break;
        case 3:
            $ecc_level = 'QR_ECLEVEL_Q';
            break;
        case 4:
            $ecc_level = 'QR_ECLEVEL_H';
            break;
        case 1:
        default:
            $ecc_level = 'QR_ECLEVEL_L';
            break;
    }

    require_once('components/phpqrcode/qrlib.php');

    // outputs image directly into browser, as PNG stream
    $v = QRcode::png($codeText, $path, $ecc_level, $size, 1);

    return $path;
}

return; ?>