<?php

namespace Gravatalonga\DriverManager;

class ExceptionManager extends \Exception
{
    public static function driverNotExists(string $name): ExceptionManager
    {
        return new self(sprintf('driver %s not exists.', $name));
    }

    public static function settingMustBeArray(): ExceptionManager
    {
        return new self('driver configuration must be array');
    }

    public static function driverMissingRequiredKey(string $driver, string $setting): ExceptionManager
    {
        return new self(sprintf('driver %s missing required setting %s', $driver, $setting));
    }
}
