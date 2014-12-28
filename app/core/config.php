<?php
class Config {
    public static function load($type) {

        if (file_exists(CONFIG_PATH . $type . EXT)) {
            return include_once CONFIG_PATH . $type . EXT;
        }

    }
}