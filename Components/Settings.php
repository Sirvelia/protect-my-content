<?php

namespace ProtectMyContent\Components;

class Settings
{    
    /**
     * get_data
     *
     * @return void
     */
    public static function get_data()
    {
        $path = PROTECTMYCONTENT_PATH . 'data/settings.php';

        if (!file_exists($path)) {
            return false;
        }

        $settings_data = include $path;
        return (array) $settings_data;
    }
}
