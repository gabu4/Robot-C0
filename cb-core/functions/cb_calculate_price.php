<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v002
 * @date 18/09/20
 */
if ( !defined('H-KEI') ) { die; }

function cb_calculate_price(float $net = 0.00, float $gross = 0.00, ?float $vat = null): array
{
    if ($vat === null) {
        $vat = CB_VAT;
    }
    $price = [];
    $price['net_price'] = (float)cb_price_clean($net);
    $price['gross_price'] = (float)cb_price_clean($gross);
    $price['vat'] = (float)$vat;
    $price['vat_price'] = (float)0;
    if (!empty($net) && empty($gross)) {
        $price['vat_price'] = (float)(($net * $vat) / 100);
        $price['gross_price'] = (float)($net + $price['vat_price']);
    } elseif (empty($net) && !empty($gross)) {
        $price['vat_price'] = (float)($price['gross_price'] - (($price['gross_price'] / (100 + $vat)) * 100));
        $price['net_price'] = (float)($price['gross_price'] - $price['vat_price']);
    } elseif (!empty($net) && !empty($gross)) {
        $price['vat_price'] = (float)($price['gross_price'] - $price['net_price']);
    }
    return $price;
}

return; ?>