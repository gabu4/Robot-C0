<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v042
 * @date 19/07/21
 */

if (!defined('H-KEI')) {
    exit;
}

date_default_timezone_set('Europe/Budapest');

$protocol = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";

define("CB_BASEDIR", @$_SERVER['SCRIPT_NAME']); // CB_BASEDIR bázis útvonal, modulban való meghíváshoz
define("CB_ROOTDIR", dirname(__FILE__)); // CB_ROOTDIR útvonal, a gyökérkönyvtáról számítva
define("CB_URI", substr(@$_SERVER['PHP_SELF'], 0, strrpos(@$_SERVER['PHP_SELF'], '/') + 1)); // a rendszer gyökér könyvtára

require_once(CB_CORE . "/sys.version.php"); // verzió információk

include_once(CB_CORE . "/init.errorlog.php"); // hibakimentés, hibakeresés, hibakiírás

/* Core functions */

/* Main Including block */
foreach (glob(CB_CORE . "/functions/*.php") as $filename) {
    require_once($filename);
}

set_time_limit('600000');

require_once(CB_CORE . "/vendor/autoload.php");

require_once(CB_CORE . "/sys.class.handler.php");
require_once(CB_CORE . "/sys.class.module.php");
require_once(CB_CORE . "/sys.class.out.console.php");

$handler = new cbcore\handler();
$module = new cbcore\module();
$console = new cbcore\out\console();

$handler->init();
$module->init();

/* Including block */

$console->printOutEnd();

return; ?>