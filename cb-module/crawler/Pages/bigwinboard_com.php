<?php

use module\crawler\pages;

class bigwinboard_com extends pages {

    public $workingdir = "./cb-results/bigwinboard_com/";

    public $url = "https://www.bigwinboard.com/";
    protected $url_data = "https://slotcatalog.com/index.php";
    protected $url_data_categories = [
        "VideoSlots"=>"blck=fltrGamesBlk&ajax=1&lang=en&typ=0&translit=Video-Slots&tag=TYPE&dt1=&dt2=&sorting=SRANK&cISO=HU&ar_prov_gtyp%5Bi148%5D=on&dt_period=&rtp_1=80.00&rtp_2=100.00&max_exp_1=10.00&max_exp_2=200000.00&min_bet_1=0.01&min_bet_2=5.00&max_bet_1=3.00&max_bet_2=2200.00",
        "ClassicSlots"=>"blck=fltrGamesBlk&ajax=1&lang=en&typ=0&translit=Classic-Slots&tag=TYPE&dt1=&dt2=&sorting=SRANK&cISO=HU&ar_prov_gtyp%5Bi149%5D=on&dt_period=&rtp_1=80.00&rtp_2=100.00&max_exp_1=10.00&max_exp_2=200000.00&min_bet_1=0.01&min_bet_2=5.00&max_bet_1=3.00&max_bet_2=2200.00",
        "CardGames"=>"blck=fltrGamesBlk&ajax=1&lang=en&typ=0&translit=Card-games&tag=TYPE&dt1=&dt2=&sorting=SRANK&cISO=HU&ar_prov_gtyp%5Bi150%5D=on&dt_period=&rtp_1=85.00&rtp_2=101.13&max_exp_1=1.00&max_exp_2=1000000.00&min_bet_1=0.01&min_bet_2=500.00&max_bet_1=50.00&max_bet_2=250000.00",
        "Roulette"=>"blck=fltrGamesBlk&ajax=1&lang=en&typ=0&translit=Roulette&tag=TYPE&dt1=&dt2=&sorting=SRANK&cISO=HU&ar_prov_gtyp%5Bi151%5D=on&dt_period=&rtp_1=85.00&rtp_2=101.13&max_exp_1=1.00&max_exp_2=1000000.00&min_bet_1=0.01&min_bet_2=500.00&max_bet_1=50.00&max_bet_2=250000.00",
        "DiceGames"=>"blck=fltrGamesBlk&ajax=1&lang=en&typ=0&translit=Dice-games&tag=TYPE&dt1=&dt2=&sorting=SRANK&cISO=HU&ar_prov_gtyp%5Bi152%5D=on&dt_period=&rtp_1=75.00&rtp_2=99.70&max_exp_1=&max_exp_2=&min_bet_1=0.01&min_bet_2=500.00&max_bet_1=5.00&max_bet_2=2000.00",
        "LiveCasino"=>"blck=fltrGamesBlk&ajax=1&lang=en&typ=0&translit=Live-Casino&tag=TYPE&dt1=&dt2=&sorting=SRANK&cISO=HU&ar_prov_gtyp%5Bi153%5D=on&dt_period=&rtp_1=85.00&rtp_2=101.13&max_exp_1=1.00&max_exp_2=1000000.00&min_bet_1=0.01&min_bet_2=500.00&max_bet_1=50.00&max_bet_2=250000.00",
        "ScratchTicket"=>"blck=fltrGamesBlk&ajax=1&lang=en&typ=0&translit=Scratch-ticket&tag=TYPE&dt1=&dt2=&sorting=SRANK&cISO=HU&ar_prov_gtyp%5Bi154%5D=on&dt_period=&rtp_1=42.88&rtp_2=98.54&max_exp_1=10.00&max_exp_2=600000.00&min_bet_1=0.01&min_bet_2=10.00&max_bet_1=0.10&max_bet_2=1000.00",
        "OtherTypes"=>"blck=fltrGamesBlk&ajax=1&lang=en&typ=0&translit=Other-types&tag=TYPE&dt1=&dt2=&sorting=SRANK&cISO=HU&ar_prov_gtyp%5Bi155%5D=on&dt_period=&rtp_1=45.76&rtp_2=99.88&max_exp_1=2.00&max_exp_2=100000.00&min_bet_1=0.01&min_bet_2=5.00&max_bet_1=3.00&max_bet_2=10000.00"
    ];
    protected $url_data_exclusive = "https://www.bigwinboard.com/online-slot-reviews/";
    protected $url_data_exclusive_page = "https://www.bigwinboard.com/online-slot-reviews/page/";
    protected $url_page = "https://roshtein.com/slots";

    protected function f_initial() {
        global $console;

        $console->nt("... page crawling in progress ...");
        $console->pc();

        $pageNumbers = 0;
        $processCountCounter = 1;
        $elemCounter = 0;

        $outputJson = [];

        if ( !empty($this->url_data_exclusive) ) {

            $url = $this->url_data_exclusive;

            $currentPage = 1;

            $response = $this->httpClient->request('GET', $url);

            $pageNumbers = $response->filter('a.page-numbers')->last()->previousAll()->text();

            $this->f_initial_getData($url, $outputJson, $elemCounter);

            $console->nt($processCountCounter . " of " . $pageNumbers . " slot " . $elemCounter . " " . $url);
            $console->pc();

            $jsonData = json_encode($outputJson);
            file_put_contents($this->workingdir . "results_1_pages.json", $jsonData);

            for ( $processCountCounter = 2; $processCountCounter <= $pageNumbers; $processCountCounter++) {
                sleep ( rand ( 2, 4));

                $url = $this->url_data_exclusive_page.$processCountCounter.'/';

                $this->f_initial_getData($url, $outputJson, $elemCounter);

                $console->nt($processCountCounter . " of " . $pageNumbers . " slot " . $elemCounter . " " . $url);
                $console->pc();

                $jsonData = json_encode($outputJson);
                file_put_contents($this->workingdir . "results_1_pages.json", $jsonData);
            }

            $console->nt("Done ...");
            $console->pc();

            exit;
        }

    }

    protected function f_initial_getData($url, &$outputJson, &$elemCounter) {
        $response = $this->httpClient->request('GET', $url);

        $response->filter('div.panel-grid-cell div.post-title a')->each(function ($node) use (&$outputJson, &$elemCounter) {
            $outputJson[crc32($node->text())] = [
                'title'=>$node->text(),
                'href'=>$node->attr('href')
            ];
            $elemCounter += 1;
        });
    }

    protected function f_crawl() {
        global $console;

        $strJsonFileContents = file_get_contents($this->workingdir . "results_1_pages.json");
        $array = json_decode($strJsonFileContents, true);

        $outputJson = [];

        $console->nt("... download in progress");
        $console->pc();

        $amount = count($array);

        $i = 1;

        if ( !empty($array) ) {
            foreach ( $array as $k=>$slot ) {

                sleep ( rand ( 2, 4));

                $outputJson[$k]['slot_name'] = $slot['title'];
                $outputJson[$k]['slot_url'] = $slot['href'];

                $url = $outputJson[$k]['slot_url'];

                $console->nt($i . " of " . $amount . " " . $url);
                $console->pc();

                $response = $this->httpClient->request('GET', $url);

                $response->filter('div.bwb-gsw-game-stats ul li')->each(function ($node) use (&$outputJson, &$elemCounter, &$k) {
                    $who = str_replace(['bwb-gsw-game-','stats__'],['','solt_'],$node->attr('class'));
                    $what = $node->filter('span')->text();
                    $text = trim(str_replace($what,'',$node->text()));
                    $what = trim(str_replace(':','',$what));

                    $outputJson[$k][$who] = [
                        'text'=>$what,
                        'value'=>$text
                    ];
                });

                $i++;

                $jsonData = json_encode($outputJson);
                file_put_contents($this->workingdir . "results_1.json", $jsonData);
            }
        }

        $jsonData = json_encode($outputJson);
        file_put_contents($this->workingdir . "results_1.json", $jsonData);

        $console->nt("Done ...");
        $console->pc();

        exit;
    }
}