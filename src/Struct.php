<?php
/**
 * Struct
 * Copyright 2020-2021 Jamiel Sharief.
 *
 * Licensed under The MIT License
 * The above copyright notice and this permission notice shall be included in all copies or substantial
 * portions of the Software.
 *
 * @copyright   Copyright (c) Jamiel Sharief
 * @license     https://opensource.org/licenses/mit-license.php MIT License
 */
declare(strict_types = 1);
namespace Struct;

use ReflectionClass;
use RuntimeException;

class Struct
{
    /**
     * @param array $properties an array of properties and data that you wish to set. No casting/conversion is done.
     */
    public function __construct(array $properties = [])
    {
        foreach ($properties as $key => $value) {
            $this->$key = $value;
        }

        if (method_exists($this, 'initialize')) {
            $this->initialize($properties);
        }
    }

    /**
     * Magic method for getting a property
     *
     * @param string $name
     * @return void
     */
    public function __get(string $name)
    {
        throw new RuntimeException(sprintf('Property %s does not exist', $name));
    }

    /**
     * Magic method for setting a property
     *
     * @param string $name
     * @param mixed $value
     */
    public function __set(string $name, $value)
    {
        throw new RuntimeException(sprintf('Property %s does not exist', $name));
    }

    /**
     * Magic method for classes exported by var_export
     *
     * @param array $data
     * @return static
     */
    public static function __set_state(array $data)
    {
        return new static($data);
    }

    /**
     * Remove references to other objects.
     *
     * Structs should be able to work with private members, in C++, the difference between
     * classes is the fact structs properies by default are public whilst classes are private.
     *
     * @return void
     */
    public function __clone()
    {
        $reflection = new ReflectionClass(static::class);

        foreach ($reflection->getProperties() as $property) {
            if (! $property->isStatic()) {
                $property->setAccessible(true);

                $value = $property->getValue($this);
                $property->setValue($this, $this->removeReferences($value));
            }
        }
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    private function removeReferences($value)
    {
        if (is_object($value)) {
            $value = clone $value;
        } elseif (is_array($value)) {
            foreach ($value as $k => $v) {
                $value[$k] = $this->removeReferences($v);
            }
        }

        return $value;
    }
}
