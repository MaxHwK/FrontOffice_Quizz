<?php

namespace Framework\Config;

class Config
{
    public static function getEnv(string $name, $default = null)
    {
        $name = strtoupper($name);

        $configBase = require(dirname(__DIR__) . '/../../config/app.php');

        $configOverloadFile = dirname(__DIR__) . '/../../config/app.local.php';
        $configOverload = [];
        if (file_exists($configOverloadFile)) {
            $configOverload = require($configOverloadFile);
        }

        $config = $configOverload + $configBase;

        return $config[$name] ?? $default;
    }

    public static function getDb(string $name, $default = null)
    {
        $name = strtoupper($name);

        $configBase = require(dirname(__DIR__) . '/../../config/db.php');

        $configOverloadFile = dirname(__DIR__) . '/../../config/db.local.php';
        $configOverload = [];
        if (file_exists($configOverloadFile)) {
            $configOverload = require($configOverloadFile);
        }

        $config = $configOverload + $configBase;

        return $config['PDO'][$name] ?? $default;
    }
}
