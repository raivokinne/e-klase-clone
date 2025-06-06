<?php

namespace Core;

class Session
{
    /**
     * @return bool
     * @param mixed $key
     */
    public static function has($key): bool
    {
        return (bool) static::get($key);
    }
    /**
     * @return void
     * @param mixed $key
     * @param mixed $value
     */
    public static function put($key, $value): void
    {
        $_SESSION[$key] = sanitize($value);
    }
    /**
     * @param mixed $key
     * @param mixed $default
     */
    public static function get($key, $default = null)
    {
        return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? $default;
    }
    /**
     * @return void
     * @param mixed $key
     * @param mixed $value
     */
    public static function flash($key, $value): void
    {
        $_SESSION['_flash'][$key] = sanitize($value);
    }
    /**
     * @return void
     */
    public static function unflash(): void
    {
        unset($_SESSION['_flash']);
    }
    /**
     * @return void
     */
    public static function flush(): void
    {
        $_SESSION = [];
    }
    /**
     * @return void
     */
    public static function destroy(): void
    {
        static::flush();

        session_destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
}

