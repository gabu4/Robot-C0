<?php
namespace module\crawler;

use cbcore\out\console as cbconsole;

/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 10/11/18
 */
if ( !defined('H-KEI') ) { exit; }

class pages {

    public $console;
    public $stage;
    public $workingdir = "./cb-results/";
    public $httpClient;
    public $url;

    function __construct(cbconsole $console,$whatStageILoad) {
        $this->console = $console;
        $this->stage = "f_".$whatStageILoad;

        $this->httpClient = new \Goutte\Client();
        if ( !is_file($this->workingdir) && !is_dir($this->workingdir) ) mkdir($this->workingdir);
    }

    public function urlFromLink($link) {
        if ( substr($link,0,1) !== '/' ) { return $link; }
        return $this->url.substr($link,1);
    }

    public function sleep() {
        //sleep(rand(1, 4));
    }

}

return; ?>
