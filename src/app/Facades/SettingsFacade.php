<?php

namespace Backpack\Settings\app\Facades;

use Illuminate\Support\Facades\Facade;

class SettingsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'settings';
    }
}
