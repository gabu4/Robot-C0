<?php

namespace module\crawler;

/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v002
 * @date 13/02/19
 */
if (!defined('H-KEI')) {
    exit;
}

class call extends funct {

    public function __call_main() {
        global $console;

        selectorStart:

        $console->n();
        $console->n();
        $console->nt('C0 Robot - page crawler');
        $console->n();
        $console->nt('Please choose one from the bottom function!');
        $console->n();
        $console->nt('-- bigwinboard.com --');
        $console->nt('1 - mapping site');
        $console->nt('2 - crawling site');
        $console->n();
        $console->nt('-- smart-baby.hu --');
        $console->nt('6 - mapping categories from site');
        $console->nt('7 - crawling product list from site');
        $console->nt('8 - crawling product details from site');
        $console->n();
        $console->nt('x - exit');
        $console->n();
        $console->nt('> ');
        $console->pc();

        $return = "";
        $console->r('',$return);

        $whoImLoad = "";
        $whatStageILoad = "";

        switch ($return) {
            case "1":
                $console->ntc('Read game lists from bigwinboard.com');
                $whoImLoad = "bigwinboard_com";
                $whatStageILoad = "initial";
                break;
            case "2":
                $console->ntc('Crawling game data from bigwinboard.com');
                $whoImLoad = "bigwinboard_com";
                $whatStageILoad = "crawl";
                break;
            case "6":
                $console->ntc('Crawling from smart-baby.hu');
                $whoImLoad = "smart_baby_hu";
                $whatStageILoad = "initial";
                break;
            case "7":
                $console->ntc('Crawling from smart-baby.hu');
                $whoImLoad = "smart_baby_hu";
                $whatStageILoad = "crawl_productlist";
                break;
            case "8":
                $console->ntc('Test Download form the site!');
                $whoImLoad = "smart_baby_hu";
                $whatStageILoad = "test";
                break;
            case "exit":
            case "quit":
            case "x":
                $console->ntc('exit');
                return true;
            default:
                $console->ntc('bad key pressed');
                goto selectorStart;
                return false;
        }

        $this->loadRollingRobot2000($whoImLoad, $whatStageILoad);

        goto selectorStart;
    }



    public function __call_init() {
        global $module;

        return $module->loadFunction('crawler', 'main');
    }

}

return;
?>
