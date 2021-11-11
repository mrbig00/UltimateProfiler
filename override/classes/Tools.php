<?php

class Tools extends ToolsCore
{
    public static function startTimer($name)
    {
        require_once _PS_MODULE_DIR_ . "ultimateprofiler/vendor/autoload.php";
        \Appiusattaprobus\ServerTiming\StopWatch::start($name);
    }

    public static function stopTimer($name)
    {
        require_once _PS_MODULE_DIR_ . "ultimateprofiler/vendor/autoload.php";
        \Appiusattaprobus\ServerTiming\StopWatch::stop($name);
    }

    public static function timerExists($timerName)
    {
        require_once _PS_MODULE_DIR_ . "ultimateprofiler/vendor/autoload.php";
        try {
            \Appiusattaprobus\ServerTiming\StopWatch::getTimer($timerName);
        } catch (Exception $exception) {
            return false;
        }

        return true;
    }
}
