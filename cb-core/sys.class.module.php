<?php
namespace cbcore;
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v054
 * @date 19/05/22
 */
if (!defined('H-KEI')) {
    exit;
}

class module
{

    protected $call = array(); //meghívható modulok listája

    protected $moduleList = [
        1=>['name'=>'crawler','function'=>'main'],
        2=>['name'=>'load','function'=>'main'],
        3=>['name'=>'store','function'=>'main']
        ]; //aktív modulok listájának tárolója
    private $moduleNameList = array(); //aktív modulok név listájának tárolója (nyelvi fájlokhoz)
    

    public function init()
    {
        $this->moduleListLoad();
        $this->moduleListInit();
    }

    protected function moduleListLoad()
    {
        foreach ($this->moduleList as $res) {
            $this->moduleLoad($res['name'], $res['function']);
        }
    }

    protected function moduleListInit()
    {
        foreach ($this->moduleNameList as $res) {
            $this->loadFunctionInit($res);
        }
    }

    private function moduleLoad($name, $function)
    {
        $this->moduleLoad_route($name, $function);
    }

    private function moduleLoad_route($name, $function)
    {
        $path = CB_ROOTDIR . '/' . CB_MODULE . '/' . $name . '-self';  //Alternatív modul útvonal (egyéni módosított modulokhoz) modulnév-self
        if (!file_exists($path)) {
            $path = CB_ROOTDIR . '/' . CB_MODULE . '/' . $name;
        }
        if (
            !isset($this->call[$name][$function]) &&
            is_file($path . '/module.php') &&
            is_file($path . '/module_database.php') &&
            is_file($path . '/module_function.php') &&
            is_file($path . '/module_call.php')
        ) {
            $this->moduleLoad_include($path, $name, $function);
        }
    }

    private function moduleLoad_include($path, $name, $function)
    {
        if (is_file($path . '/function.php')) {
            include_once($path . '/function.php');
        }
        include_once($path . '/module.php');
        if (isset($subModuleFile) && !empty($subModuleFile)) {
            $this->moduleLoad_subModuleFileLoad($path, $subModuleFile);
        }
        include_once($path . '/module_database.php');
        include_once($path . '/module_function.php');
        include_once($path . '/module_call.php');

        $module = 'module_' . $name;
        $moduleName = 'module\\' . $name . '\call';

        global $$module;
        if (empty($$module)) {
            $$module = new $moduleName;
        }

        if (!isset($this->call[$name])) {
            $this->call[$name] = array();
            $this->moduleNameList[] = $name;
        }

        $functionName = '__call_' . $function;

        if (method_exists($moduleName, $functionName)) {
            $this->call[$name][$function] = 1;
        }
    }

    private function moduleLoad_subModuleFileLoad($path, $subModuleFile)
    {
        foreach ($subModuleFile as $subModule) {
            if (is_file($path . '/module_' . $subModule . '.php')) {
                include_once($path . '/module_' . $subModule . '.php');
            }
            if (is_file($path . '/module_database_' . $subModule . '.php')) {
                include_once($path . '/module_database_' . $subModule . '.php');
            }
            if (is_file($path . '/module_function_' . $subModule . '.php')) {
                include_once($path . '/module_function_' . $subModule . '.php');
            }
            if (is_file($path . '/module_call_' . $subModule . '.php')) {
                include_once($path . '/module_call_' . $subModule . '.php');
            }
        }
    }

    /* <!-- funkció meghívás modulból */

    public $loadFunctionCallForm = "";

    /** Modul funkció betöltése (belső)
     *
     * @param string $cModule modul neve
     * @param string $cFunction funkció neve (__call_ előtag nélkül)
     * @param mixed $cSettings átadandó paraméterek (statikus vagy tömb, a tömb tömbként kerül átadásra!)
     * @return mixed az adott modul visszatérési eredménye
     */
    public function loadFunction($cModule, $cFunction = 'main', $cSettings = null)
    {
        $cModule = strtolower($cModule);
        $cModule_m = 'module_' . $cModule;
        $cFunction = strtolower($cFunction);
        
        if (!isset($this->call[$cModule][$cFunction])) {
            cbd('false content call '.$cModule);
            return false;
        }
        $cFunction = "__call_" . $cFunction;

        
        global $$cModule_m;
        $ret = $$cModule_m->$cFunction($cSettings);
        
        if ($ret === '' || $ret === false) {
            return false;
        }

        return $ret;
    }

    /* funkció meghívás modulból --!> */

    public function loadFunctionInit($cModule)
    {
        $cModule = strtolower($cModule);
        $cModule_m = 'module_' . $cModule;

        if (!isset($this->call[$cModule]['main'])) {
            return false;
        }

        global $$cModule_m;
        if (method_exists($$cModule_m, '__call_init')) {
            $ret = $$cModule_m->__call_init();
        } else {
            return false;
        }
        if ($ret === '' || $ret === false) {
            return false;
        }

        return $ret;
    }

}

return; ?>
