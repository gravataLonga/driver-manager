<?php declare(strict_types=1);

namespace Gravatalonga\DriverManager;

final class Manager
{
    /**
     * @var array<string, mixed>
     */
    private array $driver;

    /**
     * @var string[]
     */
    private array $required;

    /**
     * @var array<string, mixed>
     */
    private array $default;

    /**
     * @param array<string, array<string, mixed>> $setting
     * @param string[] $required
     * @param array<string, mixed> $default
     * @throws ExceptionManager
     */
    public function __construct(array $setting, array $required = [], array $default = [])
    {
        $this->required = $required;
        $this->default = $default;
        $this->driver = $this->ensureSettingIsCorrect($setting);
    }

    /**
     * @param string $name
     * @return array<string, mixed>
     * @throws ExceptionManager
     */
    public function driver(string $name): array
    {
        if (! array_key_exists($name, $this->driver)) {
            throw ExceptionManager::driverNotExists($name);
        }

        return $this->driver[$name];
    }

    /**
     * @param array<string, mixed> $setting
     * @return array<string, mixed>
     * @throws ExceptionManager
     */
    private function ensureSettingIsCorrect(array $setting): array
    {
        $hasItemsNotArray = array_filter($setting, [$this, 'isArray']);

        if (count($hasItemsNotArray) > 0) {
            throw ExceptionManager::settingMustBeArray();
        }

        foreach ($setting as $driver => $configuration) {
            foreach ($this->required as $keyRequired) {
                if (! array_key_exists($keyRequired, $configuration)) {
                    throw ExceptionManager::driverMissingRequiredKey($driver, $keyRequired);
                }
            }
        }

        if (is_array($this->default) && count($this->default) > 0) {
            foreach ($setting as $driver => $configuration) {
                $setting[$driver] = $this->mergeWithDefault($configuration);
            }
        }

        return $setting;
    }

    /**
     * @param mixed $item
     * @return bool
     */
    private function isArray($item): bool
    {
        return ! is_array($item);
    }

    /**
     * @param array<string, mixed> $setting
     * @return array<string, mixed>
     */
    private function mergeWithDefault(array $setting): array
    {
        foreach ($this->default as $key => $value) {
            if (! isset($setting[$key])) {
                $setting[$key] = $value;
            }
        }

        return $setting;
    }
}
