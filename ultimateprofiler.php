<?php

use Appiusattaprobus\ServerTiming\StopWatch;

class UltimateProfiler extends Module
{
    protected $hooks = [
        'moduleRoutes',
        'actionOutputHTMLBefore',
        'actionAjaxDieBefore',
    ];

    public function __construct()
    {
        $this->name = 'ultimateprofiler';
        $this->tab = 'others';
        $this->version = '1.0.1';
        $this->author = 'Zoltan Szanto';
        $this->need_instance = 1;

        $this->bootstrap = true;

        parent::__construct();
        require_once _PS_MODULE_DIR_ . "ultimateprofiler/vendor/autoload.php";
        $this->displayName = $this->l('Ultimate Profiler');
        $this->description = $this->l('Profiling Prestashop with ServerTimingAPI');

        $this->ps_versions_compliancy = ['min' => '1.7', 'max' => _PS_VERSION_];
    }

    public function install()
    {
        parent::install();
        foreach ($this->hooks as $hook) {
            $this->registerHook($hook);
        }

        return true;
    }

    public function hookActionOutputHTMLBefore()
    {
        \Appiusattaprobus\ServerTiming\StopWatch::setTimingHeader();
    }

    public function hookActionAjaxDieBefore()
    {
        \Appiusattaprobus\ServerTiming\StopWatch::setTimingHeader();
    }
}
