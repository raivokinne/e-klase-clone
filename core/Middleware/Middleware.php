<?php

namespace Core\Middleware;

class Middleware
{
    public const MAP = [
        'teacher' => Teacher::class,
        'student' => Student::class,
        'auth' => Auth::class,
        'admin' => Admin::class,
    ];
    /**
     * @return void
     * @param mixed $key
     */
    public static function resolve($keys): void
    {
        if (!$keys) {
            return;
        }

        if (is_string($keys)) {
            $middleware = static::MAP[$keys] ?? false;
            if (!$middleware) {
                throw new \Exception("No matching middleware found for key '{$keys}'.");
            }
            (new $middleware)->handle();
            return;
        }

        foreach ($keys as $key) {
            $middleware = static::MAP[$key] ?? false;
            if (!$middleware) {
                throw new \Exception("No matching middleware found for key '{$key}'.");
            }

            $instance = new $middleware;

            try {
                $instance->handle();
                return;
            } catch (\Exception $e) {
                continue;
            }
        }

        redirect('/');
    }
}
