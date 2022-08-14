<?php

namespace cbcore\out;

/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v056
 * @date 19/07/21
 */
if (!defined('H-KEI')) {
    exit;
}

class console {

    private $outText = ""; //aktuális oldal tartalom tároló

    public function text($text) {
        $this->outText .= $text;
        return true;
    }

    public function newLine() {
        $this->outText .= "\n";
        return true;
    }

    public function printOut() {
        echo $this->outText;
        return true;
    }

    public function clean() {
        $this->outText = "";
        return true;
    }

    public function readLine($text, &$return) {
        $return = readline($text);
        return true;
    }

    public function newLineText($text) {
        $this->outText .= "\n" . $text;
        return true;
    }

    public function printOutClean() {
        echo $this->outText;
        $this->outText = "";
        return true;
    }

    public function printOutEnd() {
        echo $this->outText;
        cb_debug_end_build();
        exit;
    }

    public function t($text) {
        return $this->text($text);
    }

    public function n() {
        return $this->newLine();
    }

    public function p() {
        return $this->printOut();
    }

    public function c() {
        return $this->clean();
    }

    public function r($text, &$return) {
        return $this->readLine($text, $return);
    }
    
    public function nt($text) {
        return $this->newLineText($text);
    }

    public function pc() {
        return $this->printOutClean();
    }

    public function ntc($text) {
        $this->newLineText($text);
        return $this->printOutClean();
    }
}

return;
?>