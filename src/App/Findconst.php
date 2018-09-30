<?php


/**
 * Class Findconst.
 *
 * Helper used in order to retrieve constants values.
 */
class Findconst
{

    /**
     * Get constant value or false if constant is not available.
     * @param $class
     * @param $const
     * @return bool|mixed
     */
    public static function find($class, $const, string $prefix = '')
    {
        $const = $class . '::' . strtoupper($prefix . $const);

        return defined($const) ? constant($const) : false;
    }


    /**
     * Find a constant value or return the default value.
     *
     * @param $class
     * @param $const
     * @param $default
     * @param string $prefix
     * @return mixed
     */
    public static function findOrDefault($class, $const, $default, string $prefix = '')
    {
        $value = static::find($class, $const, $prefix);

        return $value ?: $default;
    }

}