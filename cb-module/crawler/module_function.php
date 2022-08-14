<?php
namespace module\crawler;
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v001
 * @date 10/11/18
 */
if ( !defined('H-KEI') ) { exit; }

class funct extends database {

    var $httpClient = '';

    protected function loadRollingRobot2000($whoImLoad, $whatStageILoad) {
        global $console;

        if ( empty($whoImLoad) || empty($whatStageILoad) ) { $console->pc();$console->nt("missing file from Pages");$console->pc();return false; }

        $filename = $whoImLoad.".php";
        if ( !is_file(CB_ROOTDIR . "/" . CB_MODULE . "/crawler/Pages/".$filename ) ) return false;
        require_once ( CB_ROOTDIR . "/" . CB_MODULE . "/crawler/pages.php" );
        require_once ( CB_ROOTDIR . "/" . CB_MODULE . "/crawler/Pages/".$filename );

        return new $whoImLoad($console,$whatStageILoad);
    }


    protected function readDataFromSite_6() {
        global $console;

        $console->nt("... page crawling in progress ...");
        $console->pc();

        $pageNumbers = 0;
        $processCountCounter = 1;
        $elemCounter = 0;

        $this->httpClient = new \Goutte\Client();
        $outputJson = [];

        if ( !empty($this->siteUrl_6) ) {

            $url = $this->siteUrl_6_data;

            $currentPage = 1;

            $response = $this->httpClient->request('GET', $url);

            $pageNumbers = $response->filter('.category_card')->first()->html();

            print_r($pageNumbers);

            exit;

            $this->readDataFromSite_1_getData($url, $outputJson, $elemCounter);

            $console->nt($processCountCounter . " of " . $pageNumbers . " slot " . $elemCounter . " " . $url);
            $console->pc();

            $jsonData = json_encode($outputJson);
            file_put_contents(CB_ROOTDIR . "/" . CB_MODULE . "/menu/results_1_pages.json", $jsonData);

            for ( $processCountCounter = 2; $processCountCounter <= $pageNumbers; $processCountCounter++) {
                sleep ( rand ( 2, 4));

                $url = $this->siteUrl_1_data_exclusive_page.$processCountCounter.'/';

                $this->readDataFromSite_1_getData($url, $outputJson, $elemCounter);

                $console->nt($processCountCounter . " of " . $pageNumbers . " slot " . $elemCounter . " " . $url);
                $console->pc();

                $jsonData = json_encode($outputJson);
                file_put_contents(CB_ROOTDIR . "/" . CB_MODULE . "/menu/results_1_pages.json", $jsonData);
            }

            $console->nt("Done ...");
            $console->pc();

            exit;
        }

    }
}

return; ?>
