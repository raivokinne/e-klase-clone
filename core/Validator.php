<?php

namespace Core;


class Validator
{
    /**
     * @return bool
     * @param mixed $value
     */
    public static function string($value): bool
    {
        return is_string($value);
    }
    /**
     * @return mixed
     * @param mixed $value
     */
    public static function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
    /**
     * @return bool
     * @param mixed $value
     * @param mixed $min
     * @param mixed $max
     */
    public static function checkLength($value, $min = 0, $max = INF): bool
    {
        $value = trim($value);
        return mb_strlen($value) >= $min && mb_strlen($value) <= $max;
    }
    /**
     * @return bool
     * @param mixed $value
     */
    public static function number($value): bool
    {
        $value = trim($value);

        return is_numeric($value);
    }
    /**
     * @return bool
     * @param mixed $value
     */
    public static function required($value = []): bool
    {
        return !isset($value) && !$value !== '';
    }
    /**
     * @param mixed $value
     */
    public static function date($value): bool
    {
        return $value !== null && strtotime($value) !== false;
    }
}
