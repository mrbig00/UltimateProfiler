<?php

class Hook extends HookCore
{
    public static function exec(
        $hook_name,
        $hook_args = [],
        $id_module = null,
        $array_return = false,
        $check_exceptions = true,
        $use_push = false,
        $id_shop = null,
        $chain = false
    ) {
        $module = Module::getInstanceById($id_module);
        $timerName = "H_{$hook_name}";
        if ($module) {
            $timerName .= "_{$module->name}";
        }

        $timerExists = Tools::timerExists($timerName);
        $timerCounter = 1;
        while ($timerExists) {
            $timerName = str_replace("_".$timerCounter, '', $timerName);
            $timerCounter++;
            $timerName .= "_$timerCounter";

            $timerExists = Tools::timerExists($timerName);
        }

        Tools::startTimer($timerName);
        $execute = parent::exec(
            $hook_name,
            $hook_args,
            $id_module,
            $array_return,
            $check_exceptions,
            $use_push,
            $id_shop,
            $chain
        );
        Tools::stopTimer($timerName);

        return $execute;
    }
}
